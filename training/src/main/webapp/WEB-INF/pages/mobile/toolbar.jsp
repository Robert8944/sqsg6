<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<html>
<head>
	<!--
	<link rel="stylesheet" type="text/css" 
		href='<c:url value="resources/css/mobile/base.css"/>'>
	-->
	<link rel="stylesheet" type="text/css"
		href='<c:url value="resources/css/mobile/toolbar.css"/>'>
</head>
<body>
	<div class="toolbar-container column-container-bottom">
		<ul class="toolbar big-font">
			<li><a href="http://www.sqs.com">SQS</a></li>
			<li><a href="">Home</a></li>
			<c:choose>
				<c:when test="${user != null}">
					<li><a href="logout">Logout</a></li>
				</c:when>
				<c:otherwise>
					<li><a href="register">Register</a></li>
					<li><a href="login">Login</a></li>
				</c:otherwise>
			</c:choose>
		</ul>
	</div>
</body>
</html>