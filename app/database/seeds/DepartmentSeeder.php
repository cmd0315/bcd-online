<?php

	class DepartmentSeeder extends BCDSeeder {

		protected $table = "departments";

		public function getData() {
			return [
				['department_id' => 'D-IT', 'department' => 'IT', 'created_at' => new DateTime, 'updated_at' => new DateTime],
				['department_id' => 'D-DIGI', 'department' => 'Digital', 'created_at' => new DateTime, 'updated_at' => new DateTime]
			];
		}
	}