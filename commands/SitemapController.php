<?php

namespace app\commands;

use yii\console\Controller;
use Yii;
use yii2tech\sitemap\File;
use yii2tech\sitemap\IndexFile;
use yii\console\Exception;

use app\models\sitemap;

class SitemapController extends Controller
{

	const MAX_RECORDS = 10;
	const MAX_RECORDS_PER_FILE = 40000;

//	protected $pages = ['Listing', 'ListingDetail', 'Dealer', 'News', 'Category', 'Static', 'LandingPages'];

	protected $basePath;

	/**
	 * Gerenate sitemap for all countries based on country code
	 */
	public function actionIndex()
	{
        // this is the directory where sitemaps would be generated
		$this->basePath = Yii::getAlias('@app/web');

		$this->generateFile();
		$this->generateIndexFile();
	}

//	protected function generateAllFiles()
//	{
//		foreach($this->pages as $page) {
//			$this->generateFile($page);
//		}
//	}

	protected function generateFile()
	{
		$siteMapFile = new File;

		$siteMapFile->fileName = 'static.xml';
		$siteMapFile->fileBasePath = $this->basePath . '/sitemap';

		$siteMapFile->writeUrl(['site/index'], ['priority' => '0.9', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
		$siteMapFile->writeUrl(['site/about'], ['priority' => '0.8', 'changeFrequency' => File::CHECK_FREQUENCY_WEEKLY]);
		$siteMapFile->writeUrl(['site/track'], ['priority' => '0.7', 'lastModified' => '2015-05-07', 'changeFrequency' => File::CHECK_FREQUENCY_MONTHLY]);
		$siteMapFile->writeUrl(['site/contact_us', 'changeFrequency' => File::CHECK_FREQUENCY_MONTHLY]);

		$siteMapFile->close();
	}

    /**
     * Generates the main sitemap index file
     */
	protected function generateIndexFile()
	{
		$siteMapIndexFile = new IndexFile;
		$siteMapIndexFile->fileName = 'sitemap.xml';
//		$siteMapIndexFile->indexBasePath = $this->basePath;      // to write the index file
		$siteMapIndexFile->fileBasePath = $this->basePath;// . '/sitemap';      // to read the sitemap files
//		$siteMapIndexFile->setFileBaseUrl(Yii::$app->params['desktopURL'].'sitemap');     // to read the files that are there
		$siteMapIndexFile->writeUp();
	}


	public function getIterations($count)
	{
		return ceil($count / self::MAX_RECORDS);
	}

	public function getFileCount($count)
	{
		return ceil($count / self::MAX_RECORDS_PER_FILE);
	}

	public function getExtractor($page)
	{
		$class = "\\app\\models\\sitemap\\".$page.'Extractor';
		return new $class;
	}
}