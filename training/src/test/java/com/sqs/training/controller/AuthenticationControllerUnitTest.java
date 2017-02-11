package com.sqs.training.controller;

import static org.hamcrest.CoreMatchers.equalTo;
import static org.junit.Assert.assertThat;

import java.util.HashMap;
import java.util.Map;

import javax.servlet.http.HttpSession;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.mock.web.MockHttpSession;
import org.springframework.security.authentication.BadCredentialsException;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.sqs.training.domain.User;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration("classpath:context-test.xml")
public class AuthenticationControllerUnitTest {
	
	private String correctReturnLoginPage = "login";
	private String correctReturnHomePage = "home";
	private String userSessionAttribute = "user";
	private String loginFormModelAttribute = "loginForm";
	private String correctUserId = "test";
	private String correctPass = "testpass";
	private String incorrectUserId = "incorrect";
	private String incorrectPass = "nopass";
	
	@Autowired
	private AuthenticationController authenticationController;
	
	@Test
	public void testDisplayLoginPage() {
		Map<String, Object> model = new HashMap<String, Object>();
		String retValue = authenticationController.displayLoginPage(model);
		assertThat(((User) model.get(loginFormModelAttribute)).equals(new User()), equalTo(true));
		assertThat(retValue, equalTo(correctReturnLoginPage));
	}
	
	@Test
	public void testLogoutUser() {
		Map<String, Object> model = new HashMap<String, Object>();
		HttpSession mockHttpSession = new MockHttpSession();
		mockHttpSession.setAttribute(userSessionAttribute, new User());
		String retValue = authenticationController.logoutUser(model, mockHttpSession);
		assertThat(mockHttpSession.getAttribute(userSessionAttribute), equalTo(null));
		assertThat(retValue, equalTo(correctReturnHomePage));
	}
	
	@Test
	public void testLoginUserSuccessful() {
		Map<String, Object> model = new HashMap<String, Object>();
		HttpSession mockHttpSession = new MockHttpSession();
		User user = new User();
		user.setUserId(correctUserId);
		user.setPassword(correctPass);
		String retValue = authenticationController.loginUser(user, model, mockHttpSession);
		assertThat(((User) mockHttpSession.getAttribute(userSessionAttribute)).equals(user), equalTo(true));
		assertThat(retValue, equalTo(correctReturnHomePage));
	}
	
	@Test(expected = BadCredentialsException.class)
	public void testLoginUserWrongUserId() {
		Map<String, Object> model = new HashMap<String, Object>();
		HttpSession mockHttpSession = new MockHttpSession();
		User user = new User();
		user.setUserId(incorrectUserId);
		user.setPassword(correctPass);
		String retValue = authenticationController.loginUser(user, model, mockHttpSession);
	}
	
	@Test(expected = BadCredentialsException.class)
	public void testLoginUserWrongPassword() {
		Map<String, Object> model = new HashMap<String, Object>();
		HttpSession mockHttpSession = new MockHttpSession();
		User user = new User();
		user.setUserId(correctUserId);
		user.setPassword(incorrectPass);
		String retValue = authenticationController.loginUser(user, model, mockHttpSession);
	}
	
	@Test(expected = BadCredentialsException.class)
	public void testLoginUserWrongUserIdAndPassword() {
		Map<String, Object> model = new HashMap<String, Object>();
		HttpSession mockHttpSession = new MockHttpSession();
		User user = new User();
		user.setUserId(incorrectUserId);
		user.setPassword(incorrectPass);
		String retValue = authenticationController.loginUser(user, model, mockHttpSession);
	}

}
