from os import system
import os.path as paths
import sys
DEFAULT_PHP_PATHS = ["E:/xampp/php", 'C:/xampp/php', 'C:/php']

EXECUTION_PATH = paths.dirname(paths.realpath(__file__))
TEMPLATE_FILE = f'{EXECUTION_PATH}\php.ini.template'
XDEBUG_FILE = f'{EXECUTION_PATH}\php_xdebug.dll'

def get_php_path():
    for default_path in DEFAULT_PHP_PATHS:
        if paths.isdir(default_path):
            if prompt(f"Found default path {default_path} - Do you want to use this?"):
                return default_path

    php_dir = ''
    while True:
        php_dir = input("Enter path to your php folder: ")
        if paths.isdir(php_dir):
            return php_dir
        print("Given path was not found, please try again.\n")

def ensure_dependencies():
    error = ''
    if not paths.isfile(TEMPLATE_FILE):
        error = f'{error} Missing template file - php.ini.template") | '

    if not paths.isfile(XDEBUG_FILE):
        error = f'{error} Missing xdebug dll file - php_xdebug.dll") | '
    return error

def generate_php_ini(php_dir):
    generated_content = []

    with open(TEMPLATE_FILE,'r') as template_file:
        for line in template_file.readlines():
            if "{{XDEBUG_LOCATION}}" in line:
                line = line.replace("{{XDEBUG_LOCATION}}", f'{php_dir}/ext/php_xdebug.dll')
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

def add_xdebug_extension(php_dir):
    destination = f'{php_dir}\ext\php_xdebug.dll'
    copy_to_folder(XDEBUG_FILE, destination)

def add_php_ini(php_dir):
    source = TEMPLATE_FILE.replace('.template', '')
    destination = f'{php_dir}\php.ini'
    copy_to_folder(source, destination)

def copy_to_folder(src, dest):
    command = f'copy "{src}" "{dest}"'
    system(command)
    print(command)

################################
print("-- XDebug Installer --")

PHP_DIR = get_php_path()

ERRORS = ensure_dependencies()
if ERRORS is not '':
    sys.exit(ERRORS)

print("Installing XDebug...")

generate_php_ini(PHP_DIR)
add_xdebug_extension(PHP_DIR)
add_php_ini(PHP_DIR)

print("\n--------- xDebug Installed -----------")
input("Press any keys to exit...")