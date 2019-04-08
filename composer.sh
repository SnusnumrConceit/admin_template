#!/bin/bash
# $1 get composer command
docker run --rm -w /composer -v $(pwd)/:/composer composer/composer $1 -v
