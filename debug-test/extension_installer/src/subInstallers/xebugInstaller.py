import sys
import os.path as paths
import utilities.utils as utils
from utilities.pathHandler import PathsHandler

class XDebugInstaller:
    def __init__(self, path_handler: PathsHandler):
        self.path_handler = path_handler
        self.xdebug_file = f'{path_handler.execution_path}\php_xdebug.dll'

        if not paths.isfile(self.xdebug_file):
            sys.exit(f'Missing xdebug dll file - php_xdebug.dll")')
        
    
    def set_config_line(self, line):
        if '{{XDEBUG_LOCATION}}' in line:
            return utils.set_placeholder(line, '{{XDEBUG_LOCATION}}', f'{self.path_handler.php_path}/ext/php_xdebug.dll')
        return line

    def install_extension(self):
        print("Installing XDebug...")
        destination = f'{self.path_handler.php_path}\ext\php_xdebug.dll'
        self.path_handler.copy_to_folder(self.xdebug_file, destination)
        print("\n--------- xDebug Installed -----------")