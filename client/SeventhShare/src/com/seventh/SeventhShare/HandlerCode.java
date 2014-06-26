package com.seventh.SeventhShare;
/**
 * Handler Code
 *
 */
public class HandlerCode {
	/**************************客户登陆&注册**************************/
	/**
	 * 登陆取消
	 */
	public final static int LOGIN_CUSTOMER_UNDO = 20;
	/**
	 * 客户登录
	 */
	public final static int LOGIN_CUSTOMER_BEGIN = 21;
	/**
	 * 登录成功
	 */
	public final static int LOGIN_CUSTOMER_SUCCESS = 22;
	/**
	 * 登陆失败
	 */
	public final static int LOGIN_CUSTOMER_FAILURE = 23;
	/**
	 * 登录成功保存数据后
	 */
	public final static int LOGIN_CUSTOMER_SAVEDATAED = 24;
	
	/**************************发表或评论博客**************************/
	/**
	 * 发表Blog
	 */
	public final static int BLOG_PUBLISH_BEGIN = 41;
	/**
	 * 取消发表
	 */
	public final static int BLOG_PUBLISH_UNDO = 42;
	/**
	 * Blog发表成功
	 */
	public final static int BLOG_PUBLISH_SUCCESS = 43;
	/**
	 * Blog发表失败
	 */
	public final static int BLOG_PUBLISH_FAILURE = 44;
	/**
	 * 删除Blog
	 */
	public final static int BLOG_PUBLISH_DELETE = 45;
}
