import sys
from os import system
import os.path as paths
import utilities.utils as utils


class PathsHandler:
    def __init__(self, root_path, config: dict):
        self.execution_path = root_path
        self.config = config
        self.php_path: str
        self.xampp_path: str
        self.php_ini_template_file = f'{self.execution_path}\php.ini.template'
        
        self._ensure_default_dependencies()
        self._set_default_paths()


    def copy_to_folder(self, src, dest):
        command = f'copy "{src}" "{dest}"'
        system(command)
        print(command)

    def _set_default_paths(self):
        self.php_path = self.try_get_path('PHP', self.config['default_php_paths'])
        self.xampp_path = self.try_get_path('XAMPP', self.config['default_xampp_paths'])

    def try_get_path(self, name, default_paths, is_mandatory = True):
        for default_path in default_paths:
            if paths.isdir(default_path):
                if utils.prompt(f"Found default path for {name}: {default_path} - Do you want to use this?"):
                    return default_path

        path = ''
        while True:
            path = input(f"Enter path to your {name} folder: ")
            if paths.isdir(path):
                return path
            if  is_mandatory:
                print("Given path was not found, please try again.\n")
            else:
                if not utils.prompt(f'Path not found - Do you want to retry setting path for {name}?'):
                    break

    def _ensure_default_dependencies(self):
        if not paths.isfile(self.php_ini_template_file):
            sys.exit(f'Missing template file - php.ini.template')