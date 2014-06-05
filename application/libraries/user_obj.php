<?php


class User_obj {

	var $id;
	var $userType; //superadmin/admin/user
	var $email;
	var $password;
	var $facebookId;
	var $firstName;
	var $lastName;
	var $displayName;
	var $gender;
	var $birthDate;
	var $profileImageFilename;
	var $address;
	var $landmark;
	var $countryId;
	var $stateId;
	var $cityId;
	var $areaId;
	var $pincode;
	var $phone;
	var $createdDate;
	var $updatedDate;
	var $lastLoginDate;
	var $status;
	var $logDetails;

	
	function __construct(){	}

	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id;	}

	function setUserType($userType){ $this->userType = $userType; }
	function getUserType(){ return $this->userType;	}
	
	function setEmail($email){ $this->email = $email; }
	function getEmail(){ return $this->email;	}
	
	function setPassword($password){ $this->password = $password; }
	function getPassword(){ return $this->password;	}
	
	function setFacebookId($facebookId){ $this->facebookId = $facebookId; }
	function getFacebookId(){ return $this->facebookId;	}
	
	function setFirstName($firstName){ $this->firstName = $firstName; }
	function getFirstName(){ return $this->firstName;	}
	
	function setLastName($lastName){ $this->lastName = $lastName; }
	function getLastName(){ return $this->lastName;	}
	
	function setDisplayName($displayName){ $this->displayName = $displayName; }
	function getDisplayName(){ return $this->displayName;	}
	
	function setGender($gender){ $this->gender = $gender; }
	function getGender(){ return $this->gender;	}
	
	function setBirthDate($birthDate){ $this->birthDate = $birthDate; }
	function getBirthDate(){ return $this->birthDate;	}
	
	function setProfileImageFilename($profileImageFilename){ $this->profileImageFilename = $profileImageFilename; }
	function getProfileImageFilename(){ return $this->profileImageFilename;	}

	function setAddress($address){ $this->address = $address; }
	function getAddress(){ return $this->address;	}
	
	function setLandmark($landmark){ $this->landmark = $landmark; }
	function getLandmark(){ return $this->landmark;	}
	
	function setCountryId($countryId){ $this->countryId = $countryId; }
	function getCountryId(){ return $this->countryId;	}
	
	function setStateId($stateId){ $this->stateId = $stateId; }
	function getStateId(){ return $this->stateId;	}
	
	function setCityId($cityId){ $this->cityId = $cityId; }
	function getCityId(){ return $this->cityId;	}
	
	function setAreaId($areaId){ $this->areaId = $areaId; }
	function getAreaId(){ return $this->areaId;	}
	
	function setPincode($pincode){ $this->pincode = $pincode; }
	function getPincode(){ return $this->pincode;	}
	
	function setPhone($phone){ $this->phone = $phone; }
	function getPhone(){ return $this->phone;	}
	
	function setCreatedDate($createdDate){ $this->createdDate = $createdDate; }
	function getCreatedDate(){ return $this->createdDate;	}
	
	function setUpdatedDate($updatedDate){ $this->updatedDate = $updatedDate; }
	function getUpdatedDate(){ return $this->updatedDate;	}
	
	function setLastLoginDate($lastLoginDate){ $this->lastLoginDate = $lastLoginDate; }
	function getLastLoginDate(){ return $this->lastLoginDate;	}
	
	function setStatus($status){ $this->status = $status; }
	function getStatus(){ return $this->status;	}

	function setLogDetails($logDetails){ $this->logDetails = $logDetails; }
	function getLogDetails(){ return $this->logDetails;	}
	
}
/*end of file*/