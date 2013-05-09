<?php
/**
*
*
*
**/
class Usagedata{
	public $view;
	public $vars;

	public function usageOverTIme(){
		
		$query = "SELECT Count(*) as qty, month(visitDate) ";
		$query .= "as month,day(visitDate) as day,year(visitDate) ";
		$query .= "as year FROM `tblRoomUsage` GROUP BY year(visitDate), ";
		$query .= "month(visitDate), day(visitDate)";
		$dbWrapper = new InteractDB();
		$dbWrapper->customMysqli($query);
		$rows = $dbWrapper->returnedRows;
		$monthArr = array(
		31, 28, 31, 30,
			31, 30, 31, 31,
			30, 3130,31
		);
		$beginMonth = $rows[0]['month'];
		$beginDay = $rows[0]['day'];
		$endMonth = $rows[count($rows)-1]['month'];
		$endDay = $rows[count($rows)-1]['day'];
		$spanMonths = $endMonth - $beginMonth;
		$dateQty = array(); // hold our return values
		$counter = 0;
		// -------- we only have a single month of data
		if($spanMonths == 0){
			// only 1 month of data
			$numDays = $endDay-$beginDay;
			for($ii=$beginDay; $ii<=$endDay; $ii++){
				// for every day
				for($zz=0; $zz<count($rows); $zz++){
					if($ii == $rows[$zz]['day']){
						$dateQty[$counter]['day'] = $rows[$zz]['day'];
						$dateQty[$counter]['qty'] = $rows[$zz]['qty'];
						$dateQty[$counter]['month'] = $rows[$zz]['month'];
						$dateQty[$counter]['year'] = $rows[$zz]['year'];
						$dateQty[$counter]['date'] = $beginMonth."-".$rows[$zz]['day'];
						$zz = count($rows);
					}else{
						$dateQty[$counter]['day'] = $ii;
						$dateQty[$counter]['qty'] = 0;
						$dateQty[$counter]['month'] = $beginMonth;
						$dateQty[$counter]['year'] = $rows[$zz]['year'];
						$dateQty[$counter]['date'] = $beginMonth."-".$ii;
					}
				}
				$counter++;
			}
		}else{
		// ------- we have several months of data
			// loop over each month
			for($mm=$beginMonth; $mm<=$endMonth; $mm++){
				// logThis($mm);
				// logThis("begin day ".$beginDay);
				// logThis("end month ".$endMonth);
				// deal with the first month
				if($mm==$beginMonth){
					// logThis("in Begin Month");
					// for every day from the beginDay to the last day of the month
					for($ii=$beginDay; $ii<=$monthArr[$mm-1]; $ii++){
						// check all of our database rows
						for($zz=0; $zz<count($rows); $zz++){
							// if we have an entry for the month and day that matches
							if($ii == $rows[$zz]['day'] && $rows[$zz]['month'] == $mm){
								// set our date...
								$dateQty[$counter]['day'] = $rows[$zz]['day'];
								$dateQty[$counter]['qty'] = $rows[$zz]['qty'];
								$dateQty[$counter]['month'] = $rows[$zz]['month'];
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$rows[$zz]['day'];
								// ...and move on
								$zz = count($rows);
							}else{
								// otherwise set our qty for that day and month to 0
								$dateQty[$counter]['day'] = $ii;
								$dateQty[$counter]['qty'] = 0;
								$dateQty[$counter]['month'] = $mm;
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$ii;
							}
						}
						$counter++;
					}
				}else if($mm!=$endMonth){
					// our month increment is not the last month
					for($ii=0; $ii<=$monthArr[$mm-1]; $ii++){
						//  create a value for each day
						for($zz=0; $zz<count($rows); $zz++){
							if($ii == $rows[$zz]['day'] && $rows[$zz]['month'] == $mm){
								$dateQty[$counter]['day'] = $rows[$zz]['day'];
								$dateQty[$counter]['qty'] = $rows[$zz]['qty'];
								$dateQty[$counter]['month'] = $rows[$zz]['month'];
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$rows[$zz]['day'];
								$zz = count($rows);
							}else{
								$dateQty[$counter]['day'] = $ii;
								$dateQty[$counter]['qty'] = 0;
								$dateQty[$counter]['month'] = $mm;
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$ii;
							}
						}
						$counter++;
					}
				}else if ($mm==$endMonth){
					for($ii=0; $ii<=$endDay; $ii++){
						// for every day
						for($zz=0; $zz<count($rows); $zz++){
							if($ii == $rows[$zz]['day'] && $rows[$zz]['month'] == $mm){
								$dateQty[$counter]['day'] = $rows[$zz]['day'];
								$dateQty[$counter]['qty'] = $rows[$zz]['qty'];
								$dateQty[$counter]['month'] = $rows[$zz]['month'];
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$rows[$zz]['day'];
								$zz = count($rows);
							}else{
								$dateQty[$counter]['day'] = $ii;
								$dateQty[$counter]['qty'] = 0;
								$dateQty[$counter]['month'] = $mm;
								$dateQty[$counter]['year'] = $rows[$zz]['year'];
								$dateQty[$counter]['date'] = $mm."-".$ii;
							}
						}
						$counter++;
					}
				}
			}
		}

		return $dateQty;
	}

	public function purpose(){
		// grab all of our purposes
		$query = "SELECT count(1) as peoples, ";
		$query .= "purpose FROM tblRoomUsage tru";
		$query .= " ,tblPurpose p WHERE tru.fkPurpose=p.pkID GROUP BY p.pkID";
		$dbWrapper = new InteractDB();
		$dbWrapper->customMysqli($query);
		$purposeData = array();
		for($ii=0; $ii<count($dbWrapper->returnedRows); $ii++){
			$purposeData[$ii]['qty'] = (int)$dbWrapper->returnedRows[$ii]['peoples'];
			$purposeData[$ii]['purpose'] = $dbWrapper->returnedRows[$ii]['purpose'];
		}
		return $purposeData;
	}
	public function byClass(){
		$array = array('tableName'=>'tblRoomUsage');
		$dbWrapper = new InteractDB('select', $array);

	}

	public function getView(){
		return $this->view;
	}

	public function getVars(){
		return $this->vars;
	}
} // end JackModel Class Def