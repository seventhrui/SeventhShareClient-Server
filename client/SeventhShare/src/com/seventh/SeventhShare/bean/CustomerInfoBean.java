package com.seventh.SeventhShare.bean;

import java.io.Serializable;

public class CustomerInfoBean implements Serializable{
	/**
	 * CustomerInfoBean
	 */
	private static final long serialVersionUID = 1L;
	/**
	 * Customer ID
	 */
	private String c_id;
	/**
	 * Customer Name
	 */
	private String c_name;
	/**
	 * Customer Phone
	 */
	private String c_phone;
	/**
	 * Customer Email
	 */
	private String c_email;
	/**
	 * Customer QQ
	 */
	private String c_qq;
	
	private String c_uptime;
	
	public CustomerInfoBean(){
		
	}
	public CustomerInfoBean(String id,String name,String phone,String email,String qq, String uptime){
		this.c_id=id;
		this.c_name=name;
		this.c_phone=phone;
		this.c_email=email;
		this.c_qq=qq;
		this.c_uptime=uptime;
	}
	public String getC_id() {
		return c_id;
	}
	public void setC_id(String c_id) {
		this.c_id = c_id;
	}
	public String getC_name() {
		return c_name;
	}
	public void setC_name(String c_name) {
		this.c_name = c_name;
	}
	public String getC_phone() {
		return c_phone;
	}
	public void setC_phone(String c_phone) {
		this.c_phone = c_phone;
	}
	public String getC_email() {
		return c_email;
	}
	public void setC_email(String c_email) {
		this.c_email = c_email;
	}
	public String getC_qq() {
		return c_qq;
	}
	public void setC_qq(String c_qq) {
		this.c_qq = c_qq;
	}
	public static long getSerialversionuid() {
		return serialVersionUID;
	}
	public String getC_uptime() {
		return c_uptime;
	}
	public void setC_uptime(String c_uptime) {
		this.c_uptime = c_uptime;
	}
	
}
