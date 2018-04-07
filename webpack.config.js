const path = require('path');

module.exports = {
    output: {
        filename: "[name].js",
        path: path.resolve(__dirname, 'private_html', 'dist'),
        chunkFilename: "commons.js",
        publicPath: "/",
    },
    mode: 'development',
};
