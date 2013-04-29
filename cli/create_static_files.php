<?php
$webDir = __DIR__ . '/../web';
$jsDir  = __DIR__ . '/../web/js';
$cssDir = __DIR__ . '/../web/css';
$imgDir = __DIR__ . '/../web/img';

$staticFileHashes = [];
$staticFileHashes = array_merge($staticFileHashes, listFileHashes($webDir));
$staticFileHashes = array_merge($staticFileHashes, listFileHashes($jsDir));
$staticFileHashes = array_merge($staticFileHashes, listFileHashes($cssDir));
$staticFileHashes = array_merge($staticFileHashes, listFileHashes($imgDir));

$webDirPath = realpath(__DIR__ . '/../web');
$contents = "<?php\nreturn [\n";
foreach ($staticFileHashes as $realPath => $hash) {
    $webPath = str_replace($webDirPath, '', $realPath);
    $shortHash = substr($hash, 0, 8);
    $contents .= "    '{$webPath}' => '{$webPath}?{$shortHash}',\n";
}
$contents .= "];\n";
file_put_contents(__DIR__ . '/../src/static_files.php', $contents);

function listFileHashes($dir)
{
    $list = [];
    $it = new DirectoryIterator($dir);
    foreach ($it as $fileInfo) {
        if ($fileInfo->isFile()) {
            if ($fileInfo->getExtension() === 'swp'
                || substr($fileInfo->getFilename(), 0, 1) === '.') {
                continue;
            }
            $list[$fileInfo->getRealPath()] = md5_file($fileInfo->getRealPath());
        }
    }
    return $list;
}
