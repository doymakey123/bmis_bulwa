<?php
class Resident {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to check if a resident exists
    public function exists($fname, $mname, $lname, $suffix) {
        $query = "SELECT COUNT(*) FROM tbl_resident WHERE fname = :fname AND mname = :mname AND lname = :lname AND suffix = :suffix";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Returns true if the resident exists
    }

    public function create($household_number, $fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $purok, $address, $mobile, $email, $voter_status, $precinct_number, $philhealth_number, $sss_gsis_number, $tin_number, $educational_attainment, $employment_status, $occupation, $monthly_annual_income, $pwd_status, $solo_parent_status, $relationship_household_head, $head_of_the_family, $type_of_dwelling, $health_condition, $vaccination_status, $blood_type, $beneficiary_program, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number) {
        
        // Check if resident already exists
        if ($this->exists($fname, $mname, $lname, $suffix)) {
            return ['success' => false, 'message' => 'Resident already exists.'];
        }


        $query = "INSERT INTO tbl_resident (household_number, fname, mname, lname, suffix, gender, dob, civil_status, nationality, religion, purok, address, mobile, email, voter_status, precinct_number, philhealth_number, sss_gsis_number, tin_number, educational_attainment, employment_status, occupation, monthly_annual_income, pwd_status, solo_parent_status, relationship_household_head, head_of_the_family, type_of_dwelling, health_condition, vaccination_status, blood_type, beneficiary_program, emergency_contact_person, emergency_contact_relationship, emergency_contact_number) VALUES (:household_number, :fname, :mname, :lname, :suffix, :gender, :dob, :civil_status, :nationality, :religion, :purok, :address, :mobile, :email, :voter_status, :precinct_number, :philhealth_number, :sss_gsis_number, :tin_number, :educational_attainment, :employment_status, :occupation, :monthly_annual_income, :pwd_status, :solo_parent_status, :relationship_household_head, :head_of_the_family, :type_of_dwelling, :health_condition, :vaccination_status, :blood_type, :beneficiary_program, :emergency_contact_person, :emergency_contact_relationship, :emergency_contact_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':household_number', $household_number);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':purok', $purok);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':voter_status', $voter_status);
        $stmt->bindParam(':precinct_number', $precinct_number);
        $stmt->bindParam(':philhealth_number', $philhealth_number);
        $stmt->bindParam(':sss_gsis_number', $sss_gsis_number);
        $stmt->bindParam(':tin_number', $tin_number);
        $stmt->bindParam(':educational_attainment', $educational_attainment);
        $stmt->bindParam(':employment_status', $employment_status);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':monthly_annual_income', $monthly_annual_income);
        $stmt->bindParam(':pwd_status', $pwd_status);
        $stmt->bindParam(':solo_parent_status', $solo_parent_status);
        $stmt->bindParam(':relationship_household_head', $relationship_household_head);
        $stmt->bindParam(':head_of_the_family', $head_of_the_family);
        $stmt->bindParam(':type_of_dwelling', $type_of_dwelling);
        $stmt->bindParam(':health_condition', $health_condition);
        $stmt->bindParam(':vaccination_status', $vaccination_status);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':beneficiary_program', $beneficiary_program);
        $stmt->bindParam(':emergency_contact_person', $emergency_contact_person);
        $stmt->bindParam(':emergency_contact_relationship', $emergency_contact_relationship);
        $stmt->bindParam(':emergency_contact_number', $emergency_contact_number);


        
        //return $stmt->execute();

        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Resident created successfully.'];
        }
        return ['success' => false, 'message' => 'Failed to create resident.'];
    }

    public function fetchAll() {
        $query = "SELECT *, STR_TO_DATE(dob, '%m/%d/%Y') AS formatted_birthday, FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) AS age FROM tbl_resident;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // public function fetchAll($purok = null) {
    //     $query = "SELECT *, STR_TO_DATE(dob, '%m/%d/%Y') AS formatted_birthday, 
    //                      FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365) AS age 
    //               FROM tbl_resident";
    
    //     if ($purok) {
    //         $query .= " WHERE purok = :purok";
    //     }
    
    //     $stmt = $this->conn->prepare($query);
    
    //     if ($purok) {
    //         $stmt->bindParam(':purok', $purok);
    //     }
    
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function fetchFiltered($purok, $voter_status, $employment_status) {
        $query = "SELECT *, STR_TO_DATE(dob, '%m/%d/%Y') AS formatted_birthday,
                         FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) AS age
                  FROM tbl_resident WHERE 1";
    
        if (!empty($purok)) {
            $query .= " AND purok = :purok";
        }
        if (!empty($voter_status)) {
            $query .= " AND voter_status = :voter_status";
        }
        if (!empty($employment_status)) {
            $query .= " AND employment_status = :employment_status";
        }
    
        $stmt = $this->conn->prepare($query);
    
        if (!empty($purok)) {
            $stmt->bindParam(':purok', $purok);
        }
        if (!empty($voter_status)) {
            $stmt->bindParam(':voter_status', $voter_status);
        }
        if (!empty($employment_status)) {
            $stmt->bindParam(':employment_status', $employment_status);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    public function update($id, $household_number, $fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $purok, $address, $mobile, $email, $voter_status, $precinct_number, $philhealth_number, $sss_gsis_number, $tin_number, $educational_attainment, $employment_status, $occupation, $monthly_annual_income, $pwd_status, $solo_parent_status, $relationship_household_head, $head_of_the_family, $type_of_dwelling, $health_condition, $vaccination_status, $blood_type, $beneficiary_program, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number) {
        
        $query = "UPDATE tbl_resident SET household_number = :household_number, fname = :fname, mname = :mname, lname = :lname, suffix = :suffix, gender = :gender, dob = :dob, civil_status = :civil_status, nationality = :nationality, religion = :religion, purok = :purok, address = :address, mobile = :mobile, email = :email, voter_status = :voter_status, precinct_number = :precinct_number, philhealth_number = :philhealth_number, sss_gsis_number = :sss_gsis_number, tin_number = :tin_number, educational_attainment = :educational_attainment, employment_status = :employment_status, occupation = :occupation, monthly_annual_income = :monthly_annual_income, pwd_status = :pwd_status, solo_parent_status = :solo_parent_status, relationship_household_head = :relationship_household_head, head_of_the_family = :head_of_the_family, type_of_dwelling = :type_of_dwelling, health_condition = :health_condition, vaccination_status = :vaccination_status, blood_type = :blood_type, beneficiary_program = :beneficiary_program, emergency_contact_person = :emergency_contact_person, emergency_contact_relationship = :emergency_contact_relationship, emergency_contact_number = :emergency_contact_number WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':household_number', $household_number);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':purok', $purok);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':voter_status', $voter_status);
        $stmt->bindParam(':precinct_number', $precinct_number);
        $stmt->bindParam(':philhealth_number', $philhealth_number);
        $stmt->bindParam(':sss_gsis_number', $sss_gsis_number);
        $stmt->bindParam(':tin_number', $tin_number);
        $stmt->bindParam(':educational_attainment', $educational_attainment);
        $stmt->bindParam(':employment_status', $employment_status);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':monthly_annual_income', $monthly_annual_income);
        $stmt->bindParam(':pwd_status', $pwd_status);
        $stmt->bindParam(':solo_parent_status', $solo_parent_status);
        $stmt->bindParam(':relationship_household_head', $relationship_household_head);
        $stmt->bindParam(':head_of_the_family', $head_of_the_family);
        $stmt->bindParam(':type_of_dwelling', $type_of_dwelling);
        $stmt->bindParam(':health_condition', $health_condition);
        $stmt->bindParam(':vaccination_status', $vaccination_status);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':beneficiary_program', $beneficiary_program);
        $stmt->bindParam(':emergency_contact_person', $emergency_contact_person);
        $stmt->bindParam(':emergency_contact_relationship', $emergency_contact_relationship);
        $stmt->bindParam(':emergency_contact_number', $emergency_contact_number);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tbl_resident WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function individual($id) {
        $query = "SELECT * FROM tbl_resident WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the id parameter to the query
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() instead of fetchAll()
    }


    public function householdMember($id, $household_number) {
        $query = "SELECT *, STR_TO_DATE(dob, '%m/%d/%Y') AS formatted_birthday, FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) AS age FROM tbl_resident WHERE id != :id AND household_number = :household_number";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':household_number', $household_number);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }


    // Function to count residents aged 60 and up
    public function countResidents60AndUp() {
        $sql = "SELECT COUNT(*) AS total_60_and_up 
                FROM tbl_resident 
                WHERE FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) >= 60";
        
        $stmt = $this->conn->prepare($sql); // Prepare the statement
        $stmt->execute(); // Execute the statement
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
        
        return $result['total_60_and_up'] ?? 0; // Return the count or 0 if not found
    }


    public function countFemales() {
        $sql = "SELECT COUNT(*) AS total_female FROM tbl_resident WHERE gender = 'Female'";
        
        $stmt = $this->conn->prepare($sql); // Prepare the query
        $stmt->execute(); // Execute the query
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
        
        return $result['total_female'] ?? 0; // Return the count or 0 if no results
    }


    public function countMales() {
        $sql = "SELECT COUNT(*) AS total_male FROM tbl_resident WHERE gender = 'Male'";
        
        $stmt = $this->conn->prepare($sql); // Prepare the query
        $stmt->execute(); // Execute the query
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result as an associative array
        
        return $result['total_male'] ?? 0; // Return the count or 0 if no results
    }


    // Function to count all residents
    public function countAllResidents() {
        // SQL query to count all residents
        $sql = "SELECT COUNT(*) AS total_residents FROM tbl_resident";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        // Fetch the result
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_residents'];
    }


    public function fetchAllSeniorCitizens() {
        $query = "SELECT *,STR_TO_DATE(dob, '%m/%d/%Y') AS formatted_birthday, FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) AS age FROM tbl_resident WHERE FLOOR(DATEDIFF(CURDATE(), STR_TO_DATE(dob, '%m/%d/%Y')) / 365.25) >= 60";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
}
?>
