#!/bin/bash
#read -p "Commit description: " desc
git add . && \
git add -u && \
git commit -m "test" && \
git push origin master