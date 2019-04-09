#!/bin/bash

# Get string in "" // yarn run development

docker run --rm -t -v $(pwd)/:/code -w /code node  $1
