USE [DX_KMS]
GO

/****** Object:  Table [dbo].[KMS_M_COURSES]    Script Date: 07/05/2024 17:18:29 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[KMS_M_COURSES](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[name] [varchar](max) NOT NULL,
	[type] [varchar](max) NULL,
	[sub_type] [varchar](max) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO


