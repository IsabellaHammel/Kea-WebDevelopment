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

