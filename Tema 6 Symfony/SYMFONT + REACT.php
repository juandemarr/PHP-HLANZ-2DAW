A cambiar en el controlador: 
/**
* @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
*/

con esto las rutas seran manejadaspor React

En el controlador, se tiene que devlver una respuesta JSON:
    $response = new Response();

    $response->headers->set('Content-Type', 'application/json');
    $response->headers->set('Access-Control-Allow-Origin', '*');

    $response->setContent(json_encode($users)); //este $users es un array de arrays (objetos?) de usuarios
    //se pasa a json con json_encode y es lo que se devuelve
        
    return $response;

Poner en tiwg: <div id="app"></div>

En el directorio del poryecto instalar webpack encore:
    composer require symfony/webpack-encore-bundle -> añade tbn webpack.config.js, crea la acarpeta assets y añade node_modules a .gitignore

    yarn install -> instala lo necesario

    //instalar react. No son todos necesarios, se podria hacer de otra forma
    yarn add @babel/preset-react --dev
    yarn add react-router-dom
    yarn add --dev react react-dom prop-types axios
    yarn add @babel/plugin-proposal-class-properties @babel/plugin-transform-runtime

Archivo webpack.config.js:
////////////////////////////////////////////////////
var Encore = require('@symfony/webpack-encore');
    
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}
    
Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    .enableReactPreset()
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')
    
    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    
    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()
    
    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()
    
    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())
    
    // enables @babel/preset-env polyfills
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })
;
    
module.exports = Encore.getWebpackConfig();

/////////////////////////////////////////////////////

Crear las carpetas y archivos de react dentro de assets/js

//En ./src/js/app.js
    
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import '../css/app.css';
import Home from './components/Home';
    
ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));

///////////////////////////////////////

crear los componentes

Para arrancarlo:
symfony server:start
yarn encore dev --watch
