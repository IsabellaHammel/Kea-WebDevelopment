from os import system
import os.path as paths
import sys
DEFAULT_PHP_PATHS = ['E:/xampp/php', 'C:/xampp/php', 'C:/php']
DEFAULT_XAMPP_PATHS = ['E:/xampp', 'C:/xampp']
PHP_PATH = ''
XAMPP_PATH = ''

EXECUTION_PATH = paths.dirname(paths.realpath(__file__))
TEMPLATE_FILE = f'{EXECUTION_PATH}\php.ini.template'
XDEBUG_FILE = f'{EXECUTION_PATH}\php_xdebug.dll'

def get_php_path():
    return try_get_path('PHP', DEFAULT_PHP_PATHS)
    
def get_xampp_path():
    return try_get_path('XAMPP', DEFAULT_XAMPP_PATHS)

def try_get_path(name, default_paths):
    for default_path in default_paths:
        if paths.isdir(default_path):
            if prompt(f"Found default path for {name}: {default_path} - Do you want to use this?"):
                return default_path

    path = ''
    while True:
        path = input(f"Enter path to your {name} folder: ")
        if paths.isdir(path):
            return path
        print("Given path was not found, please try again.\n")

def ensure_dependencies():
    error = ''
    if not paths.isfile(TEMPLATE_FILE):
        error = f'{error} Missing template file - php.ini.template") | '

    if not paths.isfile(XDEBUG_FILE):
        error = f'{error} Missing xdebug dll file - php_xdebug.dll") | '
    return error

def generate_php_ini():
    generated_content = []
    with open(TEMPLATE_FILE, 'r') as template_file:
        for line in template_file.readlines():
            if "{{XDEBUG_LOCATION}}" in line:
                line = line.replace("{{XDEBUG_LOCATION}}", f'{PHP_PATH}/ext/php_xdebug.dll')
                print(f'Added: {line}')
            if "{{PHP_DIR}}" in line:
                line = line.replace("{{PHP_DIR}}", f'{PHP_PATH}')
                print(f'Added: {line}')
            if "{{XAMPP_DIR}}" in line:
                line = line.replace("{{XAMPP_DIR}}", f'{XAMPP_PATH}')
                print(f'Added: {line}')

            generated_content.append(line)
    
    actualFile = TEMPLATE_FILE.replace('.template', '')
    with open(actualFile, 'w') as file:
        file.writelines(generated_content)

def prompt(message):
    while True:
        is_confirm = input(message + ' [y/n]: ')
        if is_confirm is 'y':
            return True
        if is_confirm is 'n':
            return False
        print('please enter y for yes or n for no')

def add_xdebug_extension():
    destination = f'{PHP_PATH}\ext\php_xdebug.dll'
    copy_to_folder(XDEBUG_FILE, destination)

def add_php_ini():
    source = TEMPLATE_FILE.replace('.template', '')
    destination = f'{PHP_PATH}\php.ini'
    copy_to_folder(source, destination)

def copy_to_folder(src, dest):
    command = f'copy "{src}" "{dest}"'
    system(command)
    print(command)

################################
print("-- XDebug Installer --")

PHP_PATH = get_php_path()
XAMPP_PATH = get_xampp_path()

ERRORS = ensure_dependencies()
if ERRORS is not '':
    sys.exit(ERRORS)

print("Installing XDebug...")

generate_php_ini()
add_xdebug_extension()
add_php_ini()

print("\n--------- xDebug Installed -----------")
input("Press any keys to exit...")