const path = require('path');
var WebpackObfuscator = require('webpack-obfuscator');


module.exports = {
    entry: './ts/index.ts',
    plugins: [
        new WebpackObfuscator({rotateStringArray: true, reservedStrings: [ '\s*' ]}, [])
    ],
    module: {
        rules: [
            {
                use: 'ts-loader',
                exclude: /node_modules/,
            },
            {
                enforce: 'post',
                use: {
                    loader: WebpackObfuscator.loader,
                    options: {
                        reservedStrings: [ '\s*' ],
                        rotateStringArray: true
                    }
                }
            }
        ],
    },
}
