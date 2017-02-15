#!/usr/bin/env bash

rsync -a --delete --exclude=output_prod/,output_dev/,bin/,.gitignore,CNAME output_prod/ .
