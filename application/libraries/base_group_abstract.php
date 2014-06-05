<?php

/**
 * Class that holds common properties with respect to listing objects like Buy-sell, Real-estate, Services, Jobs, events etc 
 * 
 * @author Sandeep Raul
 * @version 1.0
 * @since 07 Aug 2012
 *
 */

class Base_group_abstract {
	// This is a dummy class so that below abstract class is loaded into memory.
}

/* Define main abstract class that will contain common properties and methods */
abstract class Base_group {
	/* define all common properties for all entity objects */

	var $id;
	
	var $categoryId;
	var $subCategoryId;
	
	var $urgent;
	var $title;	
	var $details;
	
	// address details
	var $contactName;
	var $phone; //will store multiple phone numbers with comman separated
	var $email;
	var $contactType;	
	var $showContactPublic;
	var $address;
	var $landmark;
	var $countryId;
	var $stateId;
	var $cityId;
	var $areaId;
	var $pincode;
	
	var $ownerId; // will be updated at later date once listing is handed over to respective owner
	var $userId; // user-id - who posted this (can be admin)
	var $listingDays;
	var $listingStartDate;
	var $listingEndDate;
	var $createdDate;
	var $updatedDate;
	var $status;
	
	
	function setId($id){ $this->id = $id; }
	function getId(){ return $this->id; }

	function setCategoryId($categoryId){ $this->categoryId = $categoryId; }
	function getCategoryId(){ return $this->categoryId; }

	function setsubCategoryId($subCategoryId){ $this->subCategoryId = $subCategoryId; }
	function getsubCategoryId(){ return $this->subCategoryId; }
			
	function setUrgent($urgent){ $this->urgent = $urgent; }
	function getUrgent(){ return $this->urgent; }
	
	function setTitle($title){ $this->title = $title; }
	function getTitle(){ return $this->title; }
	
	function setDetails($details){ $this->details = $details; }
	function getDetails(){ return $this->details; }
		
	function setContactName($contactName){ $this->contactName = $contactName; }
	function getContactName(){ return $this->contactName; }
		
	function setPhone($phone){ $this->phone = $phone; }
	function getPhone(){ return $this->phone; }
		
	function setEmail($email){ $this->email = $email; }
	function getEmail(){ return $this->email; }
	
	function setContactType($contactType){ $this->contactType = $contactType; }
	function getContactType(){ return $this->contactType; }
	
	function setShowContactPublic($showContactPublic){ $this->showContactPublic = $showContactPublic; }
	function getShowContactPublic(){ return $this->showContactPublic; }
	
	function setAddress($address){ $this->address = $address; }
	function getAddress(){ return $this->address; }
		
	function setLandmark($landmark){ $this->landmark = $landmark; }
	function getLandmark(){ return $this->landmark; }
	
	function setCountryId($countryId){ $this->countryId = $countryId; }
	function getCountryId(){ return $this->countryId;	}
	
	function setStateId($stateId){ $this->stateId = $stateId; }
	function getStateId(){ return $this->stateId;	}
	
	function setCityId($cityId){ $this->cityId = $cityId; }
	function getCityId(){ return $this->cityId;	}
	
	function setAreaId($areaId){ $this->areaId = $areaId; }
	function getAreaId(){ return $this->areaId;	}
		
	function setPincode($pincode){ $this->pincode = $pincode; }
	function getPincode(){ return $this->pincode; }
		
	function setOwnerId($ownerId){ $this->ownerId = $ownerId; }
	function getOwnerId(){ return $this->ownerId; }
			
	function setUserId($userId){ $this->userId = $userId; }
	function getUserId(){ return $this->userId; }
		
	function setListingDays($listingDays){ $this->listingDays = $listingDays; }
	function getListingDays(){ return $this->listingDays; }
	
	function setListingStartDate($listingStartDate){ $this->listingStartDate = $listingStartDate; }
	function getListingStartDate(){ return $this->listingStartDate; }
	
	function setListingEndDate($listingEndDate){ $this->listingEndDate = $listingEndDate; }
	function getListingEndDate(){ return $this->listingEndDate; }
	
	function setCreatedDate($createdDate){ $this->createdDate = $createdDate; }
	function getCreatedDate(){ return $this->createdDate; }
	
	function setUpdatedDate($updatedDate){ $this->updatedDate = $updatedDate; }
	function getUpdatedDate(){ return $this->updatedDate; }
	
	function setStatus($status){ $this->status = $status; }
	function getStatus(){ return $this->status; }
	
	
}
/*end of file*/