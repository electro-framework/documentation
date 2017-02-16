#!/bin/bash

source conf.cfg

git add /Users/alex/Sites/docSami/staticOutput/localhost/~alex/ && \
git commit --author="$nome <$email>" -m "whatever" && \
git push origin master