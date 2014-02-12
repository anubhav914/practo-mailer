<?php

class Email extends CI_Model {

    /**
     * [getSentEmails returns the email sent by desired email]
     * @param  [string] $emailId [the from addr of emails]
     * @return [assoc array]          []
     */
    public function getSentEmails($emailId){
    	$query = $this->db->query("SELECT e.to, e.subject, et.text FROM emails as e inner join email_texts as et on et.id = e.text_id where e.from = '"  . $emailId . "'");
    	$result =  $query->result_array();
    	log_message('info', $this->db->last_query());
    	return $result;
    }

    /**
     * saves the email send to the users in the Database;
     * @param  [array] $to      [an array of patient email ids]
     * @param  [string] $text    [the mail text to be sent to all the patients]
     * @param  [string] $subject [subject of the mail]
     * @param  [string] $from    [email of the sender]
     * @return [void]          [description]
     */
    public function saveSendMails($to, $text, $subject, $from){
    	$textId = $this->saveMailText($text);
    	foreach ($to as $patient ) {
    		$data = array('to' => $patient, 'from' => $from, 'subject' => $subject, 'text_id' => $textId);
    		$this->db->insert('emails', $data);
    	}
    }

    /**
     * save the  mail text in the database
     * @param  [string] $text [mail text]
     * @return [type]       [description]
     */
    public function saveMailText($text){
    	$data = array('text' => $text);
    	$this->db->insert('email_texts', $data);
    	return $this->db->insert_id();
    }
}