<?php

class BuildShell extends Shell {

    public function main() {

        $this->out('Running build');

        $path = VENDORS . 'cakephp-plugin' . DS . 'WebpackFrontend' . DS . 'bin' . DS;

        $build_cmd = 'cd ' . $path . ' && node build --webpack-config ' . $this->params['config'];

        $this->out(shell_exec($build_cmd));

    }

    public function getOptionParser() {
        $parser = parent::getOptionParser();

        return $parser->addOption('config', [
            'short' => 'c',
            'default' => ROOT . DS . 'webpack.config.js',
            'help' => 'Absolute path to a Webpack config file, will be merged with plugin defaults',
        ]);
    }
}
