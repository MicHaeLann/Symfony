<?php

namespace MoaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
	* Get customized json format by provider id
	* @param Integer $provider_id
	* @param Request $request
	* @return Response
	*/
    public function indexAction(Request $request, $provider_id)
    {
    	// get provider data
    	$provider = $this->getDoctrine()
    				->getRepository('MoaBundle:Provider')
    				->find($provider_id);

    	// throw error when couldn't find id in database
    	// if (empty($provider)) {
    	// }

    	// fetch data from provider
    	$provider_data = $this->getProviderData($provider->getProviderUrl());

    	// get provider employee data
    	$employee_data = $this->formatProviderEmployee($provider_id, $provider_data);

    	// get format structure
    	$format_provider = $this->getFormatProvider($provider, $employee_data);

        return $this->render('MoaBundle:Default:index.html.twig', array(
        	'format' => $format_provider
        ));
    }

    /**
    * Get provider data by url
    * @param String $provider_url
    * @return Json $data
    */
    private function getProviderData($provider_url)
    {
    	$ch = curl_init();

    	curl_setopt($ch, CURLOPT_URL, $provider_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
    	
    	$data = curl_exec($ch);

    	curl_close($ch);

    	return $data;
    }

    /**
    * Format provider employee by id
    * @param Integer $provider_id
    * @param Json $provider_data
    * @return Array $employees
    */
    private function formatProviderEmployee($provider_id, $provider_data)
    {    	
    	switch ($provider_id) {
    		case 1:
    			$employees = $this->getProvider1Employees($provider_data);
    			break;
    		case 2:
    			$employees = $this->getProvider2Employees($provider_data);
    			break;
    		default:
    			break;
    	}

    	return $employees;
    }

    /**
    * Get provider 1 employees strategy
    * @param Object $provider_data
    * @return Array $employees
    */
    private function getProvider1Employees($provider_data)
    {
    	// initialize return data
    	$employees = array();

    	// decode provider data 
		$provider_data = json_decode($provider_data, true);
		$provider_departments = $provider_data['departments'];
		foreach ($provider_departments as $provider_department) {
			foreach ($provider_department['members'] as $deparment_member) {
				$employee['name'] = $deparment_member;
				$employee['department'] = $provider_department['name'];

				// rewrite 'sales' to 'Sales'
				// $employee['department'] = strtolower($provider_department['name']) == 'sales' ? 'Sales' : $provider_department['name'];

				$employees[] = $employee;
			}
		}

		return $employees;
    }

    /**
    * Get provider 2 employees strategy
    * @param Object $provider_data
    * @return Array $employees
    */
    private function getProvider2Employees($provider_data)
    {
    	// initialize return data
    	$employees = array();

		// decode provider data 
		$provider_data = json_decode($provider_data, true);

		// create department id name array
		$deparments = array();

		$provider_departments = $provider_data['departments'];
		foreach ($provider_departments as $department) {
			$deparments[$department['id']] = $department['name'];
		}

		// link employee with department name
		$provider_employees = $provider_data['employees'];
		foreach ($provider_employees as $provider_employee) {

			// get department id key
			$employee_keys = array_keys($provider_employee);
			foreach ($employee_keys as $employee_key) {
				if (strpos($employee_key, 'department') !== false) {
					$deparment_id_key = $employee_key;
					break;
				}
			}

			// get employee array
			$department_id = $provider_employee[$deparment_id_key];
			$employee['name'] = $provider_employee['name'];
			$employee['department'] = $deparments[$department_id];

			// rewrite 'sales' to 'Sales'
			// $employee['department'] = strtolower($deparments[$department_id]) == 'sales' ? 'Sales' : $deparments[$department_id];
			
			$employees[] = $employee;
		}

		return $employees;
    }

    /**
    * Format the repsonse structure
    * @param Object $provider
    * @param Array $employees
    * @return Json $format_data
    */
    private function getFormatProvider($provider, $employees)
    {
    	$format_provider = array();
    	$format_provider['provider'] = $provider->getProviderName();
    	$format_provider['employees'] = $employees;

    	$format_data = json_encode($format_provider);

    	return $format_data;
    }
}
