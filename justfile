set dotenv-load

home := env_var_or_default('HOME', '~')
daylogs := env_var_or_default('DAYLOGS', home / 'Dropbox/daylogs')

default:
  just --list

month month year="2023":
  #!/bin/bash
  ls {{daylogs}}/{{year}}/{{year}}-{{month}}-*.md | sort -n | xargs bin/to-html | w3m -T text/html

month-html month year="2023":
  #!/bin/bash
  ls {{daylogs}}/{{year}}/{{year}}-{{month}}-*.md | sort -n | xargs bin/to-html

