from utilities.pathHandler import PathsHandler
from subInstallers.xebugInstaller import XDebugInstaller
from subInstallers.pgsqlInstaller import PostgresSQLInstaller
import sys
import json
import os.path as paths
import utilities.utils as utils

class MainInstaller:
    def __init__(self):
        self.config = json.load(open('config.json'))
        self.path_handler = PathsHandler(paths.dirname(paths.realpath(__file__)), self.config)
        self.xdebug_installer = XDebugInstaller(self.path_handler)
        self.pgsql_installer = PostgresSQLInstaller(self.config, self.path_handler)
    
    def install(self):
        print('Building php.ini ...')
        self._generate_php_ini()
        
        print('installing php.ini ...')
        self._instal_php_ini()

        print('installing xdebug ...')
        self.xdebug_installer.install_extension()

    def _generate_php_ini(self):
        file_path = self.path_handler.php_ini_template_file
        generated_content = []
        with open(file_path, 'r') as template_file:
            for line in template_file.readlines():
                line = self._set_default_placeholders(line)
                line = self.xdebug_installer.set_config_line(line)
                line = self.pgsql_installer.set_config_line(line)
                generated_content.append(line)

        actual_file = file_path.replace('.template', '')
        with open(actual_file, 'w') as file:
            file.writelines(generated_content)
        

    def _set_default_placeholders(self, line):
        if '{{PHP_DIR}}' in line:
            line = utils.set_placeholder(line, '{{PHP_DIR}}', f'{self.path_handler.php_path}')
        
        if '{{XAMPP_DIR}}' in line:
            line = utils.set_placeholder(line, '{{XAMPP_DIR}}', f'{self.path_handler.xampp_path}')
        return line

    def _instal_php_ini(self):
        source = self.path_handler.php_ini_template_file.replace('.template', '')
        destination = f'{self.path_handler.php_path}\php.ini'
        self.path_handler.copy_to_folder(source, destination)


################################
print("-- XDebug and PostgreSQL Installer --")

main = MainInstaller()
main.install()

input("Press any keys to exit...")