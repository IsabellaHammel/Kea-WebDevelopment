import os.path as paths
import utilities.utils as utils
from utilities.pathHandler import PathsHandler

class PostgresSQLInstaller:
    def __init__(self, config: dict, path_handler: PathsHandler):
        self.config = config
        self.path_handler = path_handler

        self.pgsql_path = self._set_pgsql_path()
        self.phpgadmin_path = f'{self.path_handler.xampp_path}/phppgadmin'
        self.phpgadmin_zipfile = f'{self.path_handler.template_path}/phppgadmin.zip'
        self.pgsql_config_inc_template_file = f'{self.path_handler.template_path}/config.inc.php.template'
        self.path_handler.ensure_template_paths([self.pgsql_config_inc_template_file, self.phpgadmin_zipfile])


    def install_extension(self):
        if self.pgsql_path is '':
            return

        print('')
        print('installing PostgresSQL')
        self._install_phpg_admin()
        print('----------- PostgresSQL Installed -----------')
        print(f'To access pqadmin goto: http://localhost/phppgadmin')


    def _install_phpg_admin(self):
        if not paths.isdir(self.phpgadmin_path):
            print(f'installing phpg_admin')
            self.path_handler.extract_zipfile(self.phpgadmin_zipfile, self.phpgadmin_path)
        else:
            print(f'phpg_admin already installed - skipping')

        self.install_config_inc_file()
        self.install_httpd_xampp_file()


    def _set_pgsql_path(self):
        if utils.prompt('(Optional) Do you want to setup PostgresSQL?'):
            return self.path_handler.try_get_path('PostgreSQL', self.config['default_pgsql_paths'], is_mandatory=False)
        return ''


    def install_config_inc_file(self):
        print('installing phpPgAdmin config_inc_file...')

        config_inc_file = self.pgsql_config_inc_template_file.replace('.template', '')
        utils.generate_content([self._config_inc_line_func], self.pgsql_config_inc_template_file, config_inc_file)

        destination = f'{self.phpgadmin_path}\\config\\config.inc.php'
        self.path_handler.copy_to_folder(config_inc_file, destination)


    def install_httpd_xampp_file(self):
        print('installing phpPgAdmin httpd-xampp.conf ..')

        httpd_file = self.path_handler.xampp_httpd_template_file.replace('.template', '')
        utils.generate_content([self._httpd_xampp_file_line_func], self.path_handler.xampp_httpd_template_file, httpd_file)

        destination = f'{self.path_handler.xampp_path}\\apache\\conf\\extra\\httpd-xampp.conf'
        self.path_handler.copy_to_folder(httpd_file, destination)


    # Line funcs -----------------------------

    def config_line_func(self, line):
        if '{{PGSQL}}' in line:
            value = 'extension=pgsql' if self.pgsql_path is not '' else ''
            return utils.set_placeholder(line, '{{PGSQL}}', value)

        if '{{PGSQL_PDO}}' in line:
            value = 'extension=pdo_pgsql' if self.pgsql_path is not '' else ''
            return utils.set_placeholder(line, '{{PGSQL_PDO}}', value)
        return line

    def _config_inc_line_func(self, line):
        if '{{PGSQL_BIN}}' in line:
            return utils.set_placeholder(line, '{{PGSQL_BIN}}', self.pgsql_path)
        return line

    def _httpd_xampp_file_line_func(self, line):
        if '{{XAMPP_DIR}}' in line:
            return utils.set_placeholder(line, '{{XAMPP_DIR}}', self.path_handler.xampp_path)
        if '{{PHPPQADMIN_DIR}}' in line:
            return utils.set_placeholder(line, '{{PHPPQADMIN_DIR}}', self.phpgadmin_path)
        return line
