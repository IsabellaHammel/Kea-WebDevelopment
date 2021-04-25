import sys
import os.path as paths
from os import system

def set_placeholder(line, placeholder, value):
    line = line.replace(placeholder, value)
    print(f'Added: {line}')
    return line

def prompt(message):
    while True:
        is_confirm = input(message + ' [y/n]: ')
        if is_confirm is 'y':
            return True
        if is_confirm is 'n':
            return False
        print('please enter y for yes or n for no')


def generate_content(set_line_funcs, file_path, destination_path):
    generated_content = []
    with open(file_path, 'r') as file:
        for line in file.readlines():
            for line_func in set_line_funcs:
                line = line_func(line)
            generated_content.append(line)

    with open(destination_path, 'w') as file:
        file.writelines(generated_content)
 