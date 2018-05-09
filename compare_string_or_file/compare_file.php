# Compare two different files content with md5_file

$md5file = file_get_contents("md5file.txt");
if (md5_file("test.txt") == $md5file)
{
  echo "The file is ok.";
}
else
{
  echo "The file has been changed.";
}
