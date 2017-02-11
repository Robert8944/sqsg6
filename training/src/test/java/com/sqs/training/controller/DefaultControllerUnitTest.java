package com.sqs.training.controller;

import static org.hamcrest.CoreMatchers.equalTo;
import static org.junit.Assert.assertThat;

import java.util.HashMap;

import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration("classpath:context-test.xml")
public class DefaultControllerUnitTest {
	
	private String correctReturn = "home";

	@Autowired
	private DefaultController defaultController;
	
	@Test
	public void testDisplayHomePage() {
		assertThat(correctReturn, equalTo(defaultController.displayHomePage(new HashMap<String, Object>())));
	}
}
