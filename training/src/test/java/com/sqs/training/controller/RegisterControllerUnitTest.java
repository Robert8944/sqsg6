package com.sqs.training.controller;

import static org.hamcrest.CoreMatchers.equalTo;
import static org.junit.Assert.assertThat;

import java.util.HashMap;
import java.util.Map;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import com.sqs.training.domain.User;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration("classpath:context-test.xml")
public class RegisterControllerUnitTest {
	
	private String correctReturnRegisterPage = "register";
	private String correctReturnHomePage = "home";
	private String registerFormModelAttribute = "registrationForm";
	
	@Autowired
	private RegisterController registerController;
	
	@Test
	public void testDisplayRegisterPage() {
		Map<String, Object> model = new HashMap<String, Object>();
		String retValue = registerController.displayRegisterPage(model);
		assertThat(((User) model.get(registerFormModelAttribute)).equals(new User()), equalTo(true));
		assertThat(retValue, equalTo(correctReturnRegisterPage));
	}
	
	@Test
	public void testRegisterUser() {
		User testUser = new User();
		testUser.setFirstName("test");
		testUser.setLastName("user");
		testUser.setPassword("testpass");
		testUser.setUserId("testuser");
		assertThat(registerController.registerUser(testUser), equalTo(correctReturnHomePage));
	}

}
