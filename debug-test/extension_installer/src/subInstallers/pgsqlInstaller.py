import sys
import os.path as paths
import utilities.utils as utils
from utilities.pathHandler import PathsHandler

class PostgresSQLInstaller:
    def __init__(self, config: dict, path_handler: PathsHandler):
        self.config = config
        self.path_handler = path_handler
        self.pgsql_path = self._set_pgsql_path()


    def _set_pgsql_path(self):
        if utils.prompt('(Optional) Do you want to setup PostgresSQL?'):
            return self.path_handler.try_get_path('PostgreSQL', self.config['default_pgsql_paths'], is_mandatory=False)
        return ''

    def set_config_line(self, line):
        if '{{PGSQL}}' in line:
            value = 'extension=pgsql' if self.pgsql_path is not '' else ''
            return utils.set_placeholder(line, '{{PGSQL}}', value)

        if '{{PGSQL_PDO}}' in line: 
            value = 'extension=pdo_pgsql' if self.pgsql_path is not '' else ''
            return utils.set_placeholder(line, '{{PGSQL_PDO}}', value)
        
        return line