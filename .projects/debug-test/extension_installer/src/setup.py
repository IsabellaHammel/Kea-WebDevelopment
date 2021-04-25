import json
import os.path as paths
from utilities.pathHandler import PathsHandler
from subInstallers.xebugInstaller import XDebugInstaller
from subInstallers.pgsqlInstaller import PostgresSQLInstaller
import utilities.utils as utils

class MainInstaller:
    def __init__(self):
        self.config = json.load(open('config.json'))
        self.path_handler = PathsHandler(paths.dirname(paths.realpath(__file__)), self.config)
        self.xdebug_installer = XDebugInstaller(self.path_handler)
        self.pgsql_installer = PostgresSQLInstaller(self.config, self.path_handler)

    def install(self):
        self._install_php_ini()
        self.xdebug_installer.install_extension()
        self.pgsql_installer.install_extension()

    def _install_php_ini(self):
        print('installing php.ini ...')
        file_path = self.path_handler.php_ini_template_file
        line_funcs = [
            self._set_default_placeholders_line_func,
            self.xdebug_installer.config_line_func,
            self.pgsql_installer.config_line_func
        ]

        actual_file = file_path.replace('.template', '')
        utils.generate_content(line_funcs, file_path, actual_file)

        source = self.path_handler.php_ini_template_file.replace('.template', '')
        destination = f'{self.path_handler.php_path}\\php.ini'
        self.path_handler.copy_to_folder(source, destination)


    def _set_default_placeholders_line_func(self, line):
        if '{{PHP_DIR}}' in line:
            line = utils.set_placeholder(line, '{{PHP_DIR}}', f'{self.path_handler.php_path}')

        if '{{XAMPP_DIR}}' in line:
            line = utils.set_placeholder(line, '{{XAMPP_DIR}}', f'{self.path_handler.xampp_path}')
        return line


################################
print("-- XDebug and PostgreSQL Installer --")

MAIN = MainInstaller()
MAIN.install()

input("Press any keys to exit...")
