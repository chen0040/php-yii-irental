<?php

class DirUtil
{
	private $filearray=array();
	private $directoryName="";
	public function __construct($directoryName="", $filter="")
	{
		$this->directoryName=$directoryName;
		$d="";
		if(is_dir($directoryName))
		{
			$d=opendir($directoryName) or die("Failed to open directory \"" . $directoryName . "\"");
			while(($f=readdir($d)) !== false)
			{
				if(is_file("$directoryName/$f") && $this->filter_file("$directoryName/$f", $filter))
				{
					$this->filearray[$f]=$this->getFileName($f);
				}
			}
			closedir($d);
		}
		else
		{
			die("\"" . $directoryName . "\" is not a directory");
		}
	}
	
	private function getFileName($path)
	{
		return substr($path, 0, (strpos($path, ".")));
	}
	
	private function filter_file($path, $filter)
	{
            if($filter=="")
            {
                return true;
            }
            $extension=substr($path, (strpos($path, ".")+1), (strlen($path)-strpos($path, ".")));
            if($extension == $filter)
            {
                    return true;
            }
            else
            {
                    return false;
            }
	}
	
	public function getDirectoryName()
	{
		return $this->directoryName;
	}
	
	public function indexOrder()
	{
		sort($this->filearray);
	}
	
	public function getCount()
	{
		return count($this->filearray);
	}
	
	public function naturalCaseInsensitiveOrder()
	{
		natcasesort($this->filearray);
	}
	
	public function getFileArray()
	{
		return $this->filearray;
	}
	
	public function display()
	{
		echo "<ol>";
		foreach($this->filearray as $key => $value)
		{
			echo "<li><a href=\"$this->directoryName/$key\">$value</a><br/>";
		}
		echo "</ol>";
	}
}

function getFilteredFiles($dir, $filter)
{
    $dirUtil=new DirUtil($dir, $filter);
    return $dirUtil->getFileArray();
}

?>