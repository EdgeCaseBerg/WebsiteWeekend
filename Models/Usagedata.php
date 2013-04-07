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
		$dbWrapper->customStatement($query);
		$rows = $dbWrapper->returnedRows;
		logThis($rows);
		$monthArr = array(
			'jan'=> 31, 'feb' => 28, 'mar' => 31, 'apr' => 30,
			'may' => 31, 'jun' => 30, 'jul' => 31, 'aug' => 31,
			'sep' => 30, 'oct' => 31, 'nov'=>30, 'dec' =>31
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
		}
		// ------- we have several months of data
		
		for($ii=0; $ii<count($rows); $ii++){
			if($rows[$ii]['month'] <= 9){
				$rows[$ii]['month'] = "0".$rows[$ii]['month'];
			}

			if($rows[$ii]['day'] <= 9){
				$rows[$ii]['day'] = "0".$rows[$ii]['day'];
			}
			$rows[$ii]['date'] = $rows[$ii]['month']."-".$rows[$ii]['day'];
		}
		return $dateQty;
	}

	public function purpose(){
		// grab all of our purposes
		$query = "SELECT count(1) as peoples, ";
		$query .= "purpose FROM tblRoomUsage tru";
		$query .= " ,tblPurpose p WHERE tru.fkPurpose=p.pkID GROUP BY p.pkID";
		$dbWrapper = new InteractDB();
		$dbWrapper->customStatement($query);
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