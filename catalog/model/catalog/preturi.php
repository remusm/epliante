<?php
class ModelCatalogPreturi extends Model {
	public function addPreturi($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "preturi SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "', tiplivrare = '" . $this->db->escape($data['tiplivrare']) . "',textcomanda = '" . $this->db->escape($data['textcomanda']) . "',produs = '" . $this->db->escape($data['produs']) . "',bucati = '" . $this->db->escape($data['bucati']) . "',pret = '" . $this->db->escape($data['pret']) . "'");

		$preturi_id = $this->db->getLastId();
/*
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "preturi SET image = '" . $this->db->escape($data['image']) . "' WHERE preturi_id = '" . (int)$preturi_id . "'");
		}

		if (isset($data['preturi_store'])) {
			foreach ($data['preturi_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "preturi_to_store SET preturi_id = '" . (int)$preturi_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'preturi_id=" . (int)$preturi_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
*/
                
		$this->cache->delete('preturi');

		return $preturi_id;
	}

	public function editPreturi($preturi_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET name = '" . $this->db->escape($data['name']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");
/*
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "preturi SET image = '" . $this->db->escape($data['image']) . "' WHERE preturi_id = '" . (int)$preturi_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "preturi_to_store WHERE preturi_id = '" . (int)$preturi_id . "'");

		if (isset($data['preturi_store'])) {
			foreach ($data['preturi_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "preturi_to_store SET preturi_id = '" . (int)$preturi_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'preturi_id=" . (int)$preturi_id . "'");
*/
		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET tiplivrare = '" . $this->db->escape($data['tiplivrare']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");

		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET textcomanda = '" . $this->db->escape($data['textcomanda']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");

		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET produs = '" . $this->db->escape($data['produs']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");

		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET bucati = '" . $this->db->escape($data['bucati']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");
                
		$this->db->query("UPDATE " . DB_PREFIX . "preturi SET pret = '" . $this->db->escape($data['pret']) . "', sort_order = '" . (int)$data['sort_order'] . "' WHERE preturi_id = '" . (int)$preturi_id . "'");

		$this->cache->delete('preturi');
	}

	public function deletePreturi($preturi_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "preturi WHERE preturi_id = '" . (int)$preturi_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "preturi_to_store WHERE preturi_id = '" . (int)$preturi_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'preturi_id=" . (int)$preturi_id . "'");

		$this->cache->delete('preturi');
	}

	public function getPreturi($preturi_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'preturi_id=" . (int)$preturi_id . "') AS keyword FROM " . DB_PREFIX . "preturi WHERE preturi_id = '" . (int)$preturi_id . "'");

		return $query->row;
	}

	public function getListapreturi($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "preturi";

		if (!empty($data['filter_name'])) {
			$sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getPreturiStores($preturi_id) {
		$preturi_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "preturi_to_store WHERE preturi_id = '" . (int)$preturi_id . "'");

		foreach ($query->rows as $result) {
			$preturi_store_data[] = $result['store_id'];
		}

		return $preturi_store_data;
	}

	public function getTotalListapreturi() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "preturi");

		return $query->row['total'];
	}
}
