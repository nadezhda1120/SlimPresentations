const express = require('express');
const slm = require('slm');
const app = express();
app.use(express.urlencoded()); // Parse URL-encoded bodies (as sent by HTML forms)
app.use(express.json()); // Parse JSON bodies (as sent by API clients)

app.post('/', (req, res) => {
    var body = ''
    var dataDecoded = Buffer.from(req.body.data, 'base64').toString('utf8');
    var slidesMeta = [];
    var start = 0;
    var slides = dataDecoded.split('\n= slide ').filter(e => e).map((e, i) => {
        var lines = e.trimRight().split('\n');
        var titles = (lines.shift().replace(/do\w*$/, '').match(/'(?:\\.|[^\\'])*'/g) || []).map(e => e.slice(1, -1));

        slidesMeta.push({
            id: i + 2,
            titles,
            start,
            end: (start += lines.length + 1)
        });

        var text = '';

        var feature;
        lines.forEach((line, i) => {
            var indent = line.match(/^\s*/g)[0];
            if (feature) {
                if (line.trim() && indent.length <= feature.indent.length) {
                    text += features[feature.name](feature);
                    feature = null;
                } else {
                    feature.lines.push(line);
                }
            } else {
                if (featureKeys.includes(line.trim())) {
                    feature = {
                        name: line.trim().slice(0, -1),
                        lines: [],
                        indent
                    };
                } else {
                    text += line + '\n';
                }
            }
        });
        if (feature) {
            text += features[feature.name](feature);
        }
        return `section\n` + titles.map(e => `  h1 ${escape(e)}\n`).join('') + text; //lines.join('\n');
    });
    slides.map((slide, i) => {
        try {
            slm.render(slide);
            body = "SUCCESS";
        } catch (e) {
            if (e.message === 'Invalid left-hand side in assignment') {
                body = 'ParseError: Unescaped = or ==';
            } else {
                body = e.message.split('\n')[0];
            }
        }
    });
    console.log("BODY => " + body);
    res.writeHead(200, {'Access-Control-Allow-Origin': '*'});
    res.write(body);
    res.end();
});

app.listen(3000, () => {
    console.log(`Server listening on port 3000`);
})

var escape = html => html.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
var lineReplace = line =>
    line.replace(/`(.*?)`/g, '<code>$1</code>')
        // [github:user/repo]
        .replace(/\[github:([^\]]*?)\]/g, '[$1](https://github.com/$1)')
        // [text](url)
        .replace(/\[([^\]]+)\]\((\S+?)\)/g, '<a href="$2">$1</a>')
var features = {
    list: ({indent, lines}) => indent + 'ul\n' + lines.filter(e => e.trim()).map(
        line => indent + '  li.action ' + lineReplace(line).trimLeft()
    ).join('\n'),

    example: ({indent, lines}) => {
        var lang = (lines[0].match(/^\s*\[lang:(\w+)\]\s*$/) || [])[1];
        if (lang) {
            lines = lines.slice(1);
        }
        var firstLine = indent + 'pre.highlight' + (lang ? '.' + lang : '') + '\n';
        return firstLine + indent + '  |\n' + lines.map(
            line => '  ' + escape(line)
        ).join('\n');
    }
};
var featureKeys = Object.keys(features).map(e => e + ':');