<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<html>
<head>
	<spring:url value="/resources/css/base.css" var="baseCss" />
	<spring:url value="/resources/css/subscribe.css" var="subscribeCss" />

	<link rel="stylesheet" type="text/css" href="${baseCss}" />
	<link rel="stylesheet" type="text/css" href="${subscribeCss}" />

	<title>SQS Training - Subscribe</title>
</head>
<body>

	<div id="mainContainer" class="main-container">
		<%@include file='header.jsp'%>
		<%@include file='toolbar.jsp'%>
		<div id="contentContainer" class="content-container column-container">
			<div id="textContainer" class="text-container column-container">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices elit eu mauris mollis mattis. Quisque id neque placerat, maximus magna pharetra, aliquet libero. Proin elit tortor, ullamcorper vel elementum eu, blandit sed augue.
			</div>
			<form:form action="subscribeEmail" method="post" commandName="emailForm" class="subscribe-email column-container">
				<div class="text-input-container">	<!-- This div undoes the scaling fix below (otherwise the text input field is too small. -->
					<form:input path="email" placeholder="Enter your email address." class="text-input column-container"/>
				</div>
				<div>	<!-- This div just fixes a flexbox scaling issue where the submit button is HUGE -->
					<input type="submit" value="Subscribe" class="raised-button column-container"/>
				</div>
			</form:form>
		</div>
	</div>
</body>
</html>