#!/bin/bash

source conf.cfg

git add . && \
#git commit --amend --author="$nome <$email>" && \
git commit -m "test" && \
git push origin master