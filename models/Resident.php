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

    public function create($fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $mobile, $email, $house_number, $purok, $brgy, $head_of_family, $household_composition, $educational_attainment, $occupation, $type_of_residency, $blood_type, $disabilities, $beneficiary_status, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number) {
        
        // Check if resident already exists
        if ($this->exists($fname, $mname, $lname, $suffix)) {
            return ['success' => false, 'message' => 'Resident already exists.'];
        }


        $query = "INSERT INTO tbl_resident (fname, mname, lname, suffix, gender, dob, civil_status, nationality, religion, mobile, email, house_number, purok, brgy, head_of_family, household_composition, educational_attainment, occupation, type_of_residency, blood_type, disabilities, beneficiary_status, emergency_contact_person, emergency_contact_relationship, emergency_contact_number) VALUES (:fname, :mname, :lname, :suffix, :gender, :dob, :civil_status, :nationality, :religion, :mobile, :email, :house_number, :purok, :brgy, :head_of_family, :household_composition, :educational_attainment, :occupation, :type_of_residency, :blood_type, :disabilities, :beneficiary_status, :emergency_contact_person, :emergency_contact_relationship, :emergency_contact_number)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':purok', $purok);
        $stmt->bindParam(':brgy', $brgy);
        $stmt->bindParam(':head_of_family', $head_of_family);
        $stmt->bindParam(':household_composition', $household_composition);
        $stmt->bindParam(':educational_attainment', $educational_attainment);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':type_of_residency', $type_of_residency);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':disabilities', $disabilities);
        $stmt->bindParam(':beneficiary_status', $beneficiary_status);
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

    public function update($id, $fname, $mname, $lname, $suffix, $gender, $dob, $civil_status, $nationality, $religion, $mobile, $email, $house_number, $purok, $brgy, $head_of_family, $household_composition, $educational_attainment, $occupation, $type_of_residency, $blood_type, $disabilities, $beneficiary_status, $emergency_contact_person, $emergency_contact_relationship, $emergency_contact_number) {
        //$query = "UPDATE tbl_resident SET name = :name, email = :email, age = :age WHERE id = :id";
        $query = "UPDATE tbl_resident SET fname = :fname, mname = :mname, lname = :lname, suffix = :suffix, gender = :gender, dob = :dob, civil_status = :civil_status, nationality = :nationality, religion = :religion, mobile = :mobile, email = :email, house_number = :house_number, purok = :purok, brgy = :brgy, head_of_family = :head_of_family, household_composition = :household_composition, educational_attainment = :educational_attainment, occupation = :occupation, type_of_residency = :type_of_residency, blood_type = :blood_type, disabilities = :disabilities, beneficiary_status = :beneficiary_status, emergency_contact_person = :emergency_contact_person, emergency_contact_relationship = :emergency_contact_relationship, emergency_contact_number = :emergency_contact_number WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':mname', $mname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':suffix', $suffix);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':civil_status', $civil_status);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':house_number', $house_number);
        $stmt->bindParam(':purok', $purok);
        $stmt->bindParam(':brgy', $brgy);
        $stmt->bindParam(':head_of_family', $head_of_family);
        $stmt->bindParam(':household_composition', $household_composition);
        $stmt->bindParam(':educational_attainment', $educational_attainment);
        $stmt->bindParam(':occupation', $occupation);
        $stmt->bindParam(':type_of_residency', $type_of_residency);
        $stmt->bindParam(':blood_type', $blood_type);
        $stmt->bindParam(':disabilities', $disabilities);
        $stmt->bindParam(':beneficiary_status', $beneficiary_status);
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
}
?>
