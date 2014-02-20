<?php

/**
 * 附件上传处理
 * 
 * @author pang
 *
 */

class Bc_Uploader
{

	/**
	 * 排序hash中的文件
	 * 
	 * @param unknown_type $hashOrders
	 */
	public static function SaveFilesOrder($hashOrders)
	{
		$arr = explode(',', $hashOrders);
		$arr || $arr = array();
		$i = 1000;
		$dao = &Bc_Db::t('attachment');
		
		foreach ($arr as $fid) {
			if ($fid) {
				$dao->saveOrder($fid, $i);
				$i += 10;
			}
		}		
	}
	
	/**
	 * 保存附件信息到数据库、服务器
	 * 
	 * @param array $params
	 */
	public static function Save(array $params)
	{
		Bc_Log::getInstance()->debug(var_export($params, true));
		$file = &$params['file'];
		$hash = &$params['hash'];
		
		$f = $_FILES[$file];
		$fid = md5(uniqid(mt_rand()));
		$ext = substr(strrchr($f['name'], '.'), 1);
		
		$width = $height = 0;
		if (preg_match('/image/i', $f['type'])) {
			list($width, $height) = getimagesize($f['tmp_name']);
		}
		
		$config = &Bc_Config::appConfig()->toArray();
		
		$s = array();
		$s['id'] = $fid;
		$s['Name'] = $f['name'];
		$s['MimeType'] = $f['type'];
		$s['Size'] = $f['size'];
		$s['Uid'] = (int)$_SESSION['uid'];
		$s['Hash'] = $hash;
		$s['Description'] = '';
		$s['Ext'] = substr(strrchr($f['name'], '.'), 1);
		$s['Width'] = $width;
		$s['Height'] = $height;

		Bc_Db::t('attachment')->insert($s);
		$storage = &Bc_File_Storage::factory($config['attachment']['save']['protocol']);

		$SavePath = $config['attachment']['save_path'];
		$storage->initDir($SavePath);
		$SavePath .= substr($fid, 0, 1).'/';
		$storage->initDir($SavePath);
		$SavePath .= substr($fid, 1, 1).'/';
		$storage->initDir($SavePath);
		
		$storage->save($f['tmp_name'], $SavePath.$fid.'.'.$s['Ext'], 'move_uploaded_file');

		$r = $f;
		$r['file_id'] = $fid;
		$r['ext'] = $s['Ext'];
		$r['err'] = '';
	
		return $r;
	}
	
	/**
	 * 删除附件
	 * 
	 * @param unknown_type $fid
	 */
	public static function Del($fid)
	{
		$config = &Bc_Config::appConfig();
		
		$file = &Bc_Db::t('attachment')->findById($fid);

		$SavePath = $config->attachment->save_path.substr($fid, 0, 1).'/'.substr($fid, 1, 1).'/'.$fid.'.'.$file->Ext;
		$storage = &Bc_File_Storage::factory($config->attachment->save->protocol);
		$storage->del($SavePath);
		
		Bc_Db::t('attachment')->doDelete($fid);
	}
}