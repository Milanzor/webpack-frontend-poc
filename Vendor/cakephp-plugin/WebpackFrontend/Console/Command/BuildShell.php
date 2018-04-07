<?php

class BuildShell extends Shell {

    public function main() {

        $path = VENDORS . 'cakephp-plugin' . DS . 'WebpackFrontend' . DS . 'bin' . DS;

        $build_cmd = 'node build --webpack-config ' . $this->params['config'] . ' --root ' . ROOT;

        $descriptorspec = [
            0 => ["pipe", "r"],   // stdin is a pipe that the child will read from
            1 => ["pipe", "w"],   // stdout is a pipe that the child will write to
            2 => ["pipe", "w"]    // stderr is a pipe that the child will write to
        ];
        $process = proc_open($build_cmd, $descriptorspec, $pipes, $path);

        if (is_resource($process)) {
            while ($s = fgets($pipes[1])) {
                $this->out($s, 0);
            }
            while ($s = fgets($pipes[2])) {
                $this->out($s, 0);
            }
        }

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
