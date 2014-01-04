<?php
/**
 * 
 */
class Ajax extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			exit;
		}
	}
	
	function GetProvinceOption(){
		$id = $this->input->post('id');
		$this->db->where('CountryID',$id);
		$row = $this->db->get('provinces');
		?>
		<option value="">Semua Provinsi</option>
		<?php
		foreach ($row->result() as $prov) {
			?>
			<option value="<?=$prov->ProvinceID?>"><?=$prov->ProvinceName?></option>
			<?php
		}
	}
	function GetCityOption(){
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		if($country > 0){
			$this->db->where('p.CountryID',$country);
		}
		if($province > 0){
			$this->db->where('p.ProvinceID',$province);
		}
		$this->db->join('provinces p', 'p.ProvinceID = c.ProvinceID','left');
		$this->db->join('countries co', 'co.CountryID = p.CountryID','left');
		$row = $this->db->get('cities c');
		
		echo '<option value="">Pilih Kota</option>';
		foreach ($row->result() as $city) {
			?>
			<option value="<?=$city->CityID?>"><?=$city->CityName?></option>
			<?php
		}
	}
	function GetCityShipment(){
		CheckLogin();
		$country = $this->input->post('country');
		$province = $this->input->post('province');
		$shipmentid = $this->input->post('shipmentid');
		if($country > 0){
			$this->db->where('p.CountryID',$country);
		}
		if($province > 0){
			$this->db->where('p.ProvinceID',$province);
		}
		$this->db->join('provinces p', 'p.ProvinceID = c.ProvinceID','left');
		$this->db->join('countries co', 'co.CountryID = p.CountryID','left');
		$row = $this->db->get('cities c');
		foreach ($row->result() as $city) {
			
			if($shipmentid){
				$this->db->where(array('CityID'=>$city->CityID,'ShipmentID'=>$shipmentid));
				$cek = $this->db->get('shipmentcost');
				if($cek->num_rows()){
					$row = $cek->row();
					$value = $row->Cost;
				}else{
					$value = 0;
				}
			}else{
				$value = 0;
			}
			?>
			<tr>
			<td><?=$city->CityName?>, <?=$city->ProvinceName?>, <?=$city->CountryName?></td>
			<td>
				<input type="hidden" name="cities[]" value="<?=$city->CityID?>" />
				<input class="angka uang" name="Tarif-<?=$city->CityID?>" value="<?=desimal($value)?>" />
			</td>
			</tr>
			<?php
		}
	}
}
