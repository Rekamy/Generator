const path = require('path');
const webpack = require('webpack');

module.exports = {
    configureWebpack: {
        plugins: [
            new webpack.optimize.LimitChunkCountPlugin({
                maxChunks: 6
            })
        ],
        resolve: {
            alias: {
                "@": path.resolve(__dirname, "src")
            },
            extensions: ['.ts', '.vue', '.json', '.scss']
        }
    },
    pwa: {
        name: 'ARGON',
        themeColor: '#172b4d',
        msTileColor: '#172b4d',
        appleMobileWebAppCapable: 'yes',
        appleMobileWebAppStatusBarStyle: '#172b4d'
    },
    css: {
        // Enable CSS source maps.
        sourceMap: process.env.NODE_ENV !== 'production'
    },
    outputDir: '../../public/vue',
    publicPath: '/vue/',
}
