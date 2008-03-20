#!/usr/bin/env python
#
# Copyright 2008 FriendFeed
#
# Licensed under the Apache License, Version 2.0 (the "License"); you may
# not use this file except in compliance with the License. You may obtain
# a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
# WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
# License for the specific language governing permissions and limitations
# under the License.

"""Makes the zip and tar.gz distribution files from this SVN client."""

import os
import os.path


def main():
    start_path = os.path.abspath(os.getcwd())
    abs_file = os.path.abspath(__file__)
    abs_dir = os.path.dirname(abs_file)
    dist_files = []
    for root, dirs, files in os.walk(os.path.dirname(__file__)):
        for name in files:
            path = os.path.abspath(os.path.join(root, name))
            if not path.endswith("~") and not path.endswith("#") and \
               not path.endswith(".tar.gz") and not path.endswith(".zip") and \
               path != abs_file:
                dist_files.append(os.path.abspath(os.path.join(root, name)))
        if ".svn" in dirs:
            dirs.remove(".svn")
    parent_dir = os.path.dirname(abs_dir) + os.sep
    full_paths = [p[len(parent_dir):] for p in dist_files]
    os.chdir(parent_dir)

    output = os.path.join(start_path, "friendfeed-api.tar.gz")
    command = "tar cvzf " + output + " " + " ".join(full_paths)
    print command
    os.system(command)

    output = os.path.join(start_path, "friendfeed-api.zip")
    command = "zip " + output + " " + " ".join(full_paths)
    print command
    os.system(command)


if __name__ == "__main__":
    main()
