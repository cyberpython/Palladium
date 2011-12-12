#*******************************************************************************
#
#   This file is part of the Palladium WordPress theme.
#
#   The Palladium WordPress theme is free software: you can redistribute it
#   and/or modify it under the terms of the GNU General Public License as
#   published by the Free Software Foundation, either version 3 of the License,
#   or (at your option) any later version.
#
#   The Palladium WordPress theme is distributed in the hope that it will be useful,
#   but WITHOUT ANY WARRANTY; without even the implied warranty of
#   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#   GNU General Public License for more details.
#
#   You should have received a copy of the GNU General Public License
#   along with the Palladium WordPress theme.
#   If not, see <http://www.gnu.org/licenses/>.
#
# ******************************************************************************
#
# required software:
#       rsvg
#

if [ -e img ]
then
  rm -rf img
fi

cp -R svg img
for i in $( ls -R img/*.svg ); do
    fname=${i%.*}.png
    rsvg $i $fname
    rm $i
done
