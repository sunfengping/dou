<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2015 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2015-06-10
 */
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}
class Excel {
    /**
     * +----------------------------------------------------------
     * 导出会员资料
     * +----------------------------------------------------------
     * $module 模块
     * $data 数据源
     * +----------------------------------------------------------
     */
  
    function export_excel($module, $data = '') {
        require (ROOT_PATH . ADMIN_PATH . '/include/phpexcel/PHPExcel.php');
        require (ROOT_PATH . ADMIN_PATH . '/include/phpexcel/Excel5.php');
        // 创建一个处理对象实例
        $objExcel = new PHPExcel();

        // 创建文件格式写入对象实例, uncomment
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);
        //*************************************
        //设置当前的sheet索引，用于后续的内容操作。
        //一般只有在使用多个sheet的时候才需要显示调用。
        //缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
        $objExcel->setActiveSheetIndex(0);
        $objActSheet = $objExcel->getActiveSheet();

        // 设置单元格宽度
        $objActSheet->getColumnDimension('C')->setAutoSize(30);
        $objActSheet->getColumnDimension('K')->setAutoSize(true);

        // 设置表格标题栏内容
        foreach ((array)$data['head'] as $key => $value) {
            $objActSheet->setCellValue($this->number_to_letter($key + 1) . '1', $value);
        }

        // 生成列表

        foreach ((array)$data['list'] as $row_number => $row) {
            $z=0;
            foreach ((array)$row as $key => $value) {
                $z=0;
                foreach ((array)$row as $key => $value) {
                    $objActSheet->setCellValue($this->number_to_letter($z + 1) . ($row_number + 2), $value);
                    $z++;
                }
            }
        }


        // 输出内容
        // 输出内容
        $outputFileName ='承揽费用助手发放模板' . date('Ymdhi').".xls";
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ua = strtolower($ua);
        if(preg_match('/msie/', $ua) || preg_match('/edge/', $ua)) { //判断是否为IE或Edge浏览器
            $outputFileName = str_replace('+', '%20', urlencode($outputFileName)); //使用urlencode对文件名进行重新编码
        }
         // 到文件
        $objWriter->save(ROOT_PATH . 'cache/' . $outputFileName);


        // 文件直接输出到浏览器
        header ( 'Pragma:public');
        header ( 'Expires:0');
        header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header ( 'Content-Type:application/force-download');
        header ( 'Content-Type:application/vnd.ms-excel');
        header ( 'Content-Type:application/octet-stream');
        header ( 'Content-Type:application/download');
        header ( 'Content-Disposition:attachment;filename='. $outputFileName );
        header ( 'Content-Transfer-Encoding:binary');
        $objWriter->save ( 'php://output');
        @unlink(ROOT_PATH . 'cache/' . $outputFileName);
    }


    /**
     * +----------------------------------------------------------
     * 导出个税表
     * +----------------------------------------------------------
     * $module 模块
     * $data 数据源
     * +----------------------------------------------------------
     */
    function export_excel2($module, $data = '') {
        require (ROOT_PATH . ADMIN_PATH . '/include/phpexcel/PHPExcel.php');
        require (ROOT_PATH . ADMIN_PATH . '/include/phpexcel/Excel5.php');
        // 创建一个处理对象实例
        $objExcel = new PHPExcel();

        // 创建文件格式写入对象实例, uncomment
        $objWriter = new PHPExcel_Writer_Excel5($objExcel);
        //*************************************
        //设置当前的sheet索引，用于后续的内容操作。
        //一般只有在使用多个sheet的时候才需要显示调用。
        //缺省情况下，PHPExcel会自动创建第一个sheet被设置SheetIndex=0
        $objExcel->setActiveSheetIndex(0);
        $objActSheet = $objExcel->getActiveSheet();

        // 设置单元格宽度
        $objActSheet->getColumnDimension('C')->setAutoSize(30);
        $objActSheet->getColumnDimension('K')->setAutoSize(true);
        // 表格标题文字
        $objActSheet->setCellValue('A1', '扣缴个人开票记录表');
        $objActSheet->mergeCells('A1:I1'); // 表格标题文字显示区域
        $objActSheet->getStyle('A1:N1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->getStyle('A1:N1')->getFont()->setBold(true);

        $objActSheet->setCellValue('A2', '所属月份：'.date('Y 年 m 月 d 日'));
        $objActSheet->setCellValue('A3', '纳税人识别号：91371100MA3QA2QR2X'.date('Y 年 m 月 d 日'));
        $objActSheet->setCellValue('E2', '金额单位：元（列至角分）');
        $objActSheet->setCellValue('E3', '纳税义务人名称：华煌信息科技（山东）有限公司');
         


        // 设置表格标题栏内容
        foreach ((array)$data['head'] as $key => $value) {
            $objActSheet->setCellValue($this->number_to_letter($key + 1) . '5', $value);
        }

        // 生成列表
        $coli = 0;
        $totalmoneys = 0;
        $taxMoneys = 0;
        $moneys = 0;
        foreach ((array)$data['list'] as $row_number => $row) {
            $z=0;
            foreach ((array)$row as $key => $value) {
                $objActSheet->setCellValue($this->number_to_letter($z + 1) . ($row_number + 6), $value);
                $coli=$row_number + 6;

                if($key=='totalMoney')
                {
                    $totalmoneys+=floatval($value);
                }
                if($key=='taxMoney')
                {
                    $taxMoneys+=floatval($value);
                }
                if($key=='money')
                {
                    $moneys+=floatval($value);
                }
                $z++;
            }
        }
        $objActSheet->setCellValue('C' . ($coli + 1), '合计');
        $objActSheet->setCellValue('F' . ($coli + 1), $totalmoneys);
        $objActSheet->setCellValue('H' . ($coli + 1), $taxMoneys);
        $objActSheet->setCellValue('I' . ($coli + 1), $moneys);

        // 输出内容
        $outputFileName ='扣缴个人开票记录表' . date('Ymdhi').".xls";
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ua = strtolower($ua);
        if(preg_match('/msie/', $ua) || preg_match('/edge/', $ua)) { //判断是否为IE或Edge浏览器
            $outputFileName = str_replace('+', '%20', urlencode($outputFileName)); //使用urlencode对文件名进行重新编码
        }
        // 到文件
        $objWriter->save(ROOT_PATH . 'cache/' . $outputFileName);
        // 文件直接输出到浏览器
        header ( 'Pragma:public');
        header ( 'Expires:0');
        header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header ( 'Content-Type:application/force-download');
        header ( 'Content-Type:application/vnd.ms-excel');
        header ( 'Content-Type:application/octet-stream');
        header ( 'Content-Type:application/download');
        header ( 'Content-Disposition:attachment;filename='. $outputFileName );
        header ( 'Content-Transfer-Encoding:binary');
        $objWriter->save ( 'php://output');
        @unlink(ROOT_PATH . 'cache/' . $outputFileName);
    }

    /**
     * +----------------------------------------------------------
     * 导出会员资料
     * +----------------------------------------------------------
     */
    function number_to_letter($number) {
        $box = array(1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D', 5 => 'E', 6 => 'F', 7 => 'G', 8 => 'H', 9 => 'I', 10 => 'J', 11 => 'K', 12 => 'L', 13 => 'M', 14 => 'N', 16 => 'O', 16 => 'P', 17 => 'Q', 18 => 'R', 19 => 'S', 20 => 'T', 21 => 'U', 22 => 'V', 23 => 'W', 24 => 'X', 25 => 'Y', 26 => 'Z');
        
        return $box[$number];
    } 
}
?>