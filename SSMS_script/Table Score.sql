USE [DX_KMS]
GO

/****** Object:  Table [dbo].[KMS_T_SCORES]    Script Date: 07/05/2024 17:24:46 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[KMS_T_SCORES](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[trainee_id] [varchar](50) NOT NULL,
	[course_id] [int] NOT NULL,
	[package_id] [int] NOT NULL,
	[actual_trainer_id] [varchar](50) NULL,
	[plan_start_date] [date] NULL,
	[plant_end_date] [date] NULL,
	[actual_start_date] [date] NULL,
	[actual_end_date] [date] NULL,
	[score_pt] [float] NULL,
	[score_ht] [float] NULL,
 CONSTRAINT [PK_KMS_T_Scores] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO

