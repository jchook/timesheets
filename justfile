set dotenv-load

home := env_var_or_default('HOME', '~')
daylogs := env_var_or_default('DAYLOGS', home / 'Dropbox/daylogs')

month month year="2022":
  #!/bin/bash
  ls {{daylogs}}/{{year}}/{{year}}-{{month}}-*.md | sort -n | xargs bin/to-html | w3m -T text/html
