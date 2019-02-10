/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.Compressor;
import edu.wpi.first.wpilibj.TimedRobot;
import edu.wpi.first.wpilibj.command.Command;
import edu.wpi.first.wpilibj.command.Scheduler;
import edu.wpi.first.wpilibj.smartdashboard.SendableChooser;
import edu.wpi.first.wpilibj.smartdashboard.SmartDashboard;
import frc.robot.commands.ExampleCommand;
import frc.robot.subsystems.*;
import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;


/**
 * The VM is configured to automatically run this class, and to call the
 * functions corresponding to each mode, as described in the TimedRobot
 * documentation. If you change the name of this class or the package after
 * creating this project, you must also update the build.gradle file in the
 * project.
 */
public class Robot extends TimedRobot {

  public static ExampleSubsystem m_subsystem = new ExampleSubsystem();
  public static OI m_oi;
  public static Claw m_claw;
  public static Elbow m_elbow;
  public static Wrist m_wrist;
  public static EndGame m_endGame;
  public static DriveTrain m_driveTrain;
  
  private CANSparkMax elbow, wrist;
  
  public static Compressor m_Compressor;

  Command m_autonomousCommand;
  SendableChooser<Command> m_chooser = new SendableChooser<>();

  /**
   * This function is run when the robot is first started up and should be
   * used for any initialization code.
   */
  @Override
  public void robotInit() {
    m_claw = new Claw();
    m_wrist = new Wrist();
    m_elbow = new Elbow();
    m_driveTrain = new DriveTrain();
    m_oi = new OI();
    m_chooser.setDefaultOption("Default Auto", new ExampleCommand());
    // chooser.addOption("My Auto", new MyAutoCommand());
    SmartDashboard.putData("Auto mode", m_chooser);    

    m_Compressor = new Compressor(RobotMap.COMPRESSOR);
    m_Compressor.start();
    m_Compressor.setClosedLoopControl(true);
 
    elbow = new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless);
    wrist = new CANSparkMax(RobotMap.WRIST_MOTOR, MotorType.kBrushless);
    /*
    m_elbowMotor = new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless);
    m_wristMotor = new CANSparkMax(RobotMap.WRIST_MOTOR, MotorType.kBrushless);
    m_intake_1 = new WPI_VictorSPX(RobotMap.INTAKE_1);
    m_intake_2 = new WPI_VictorSPX(RobotMap.INTAKE_2);
    */
  }

  /**
   * This function is called every robot packet, no matter the mode. Use
   * this for items like diagnostics that you want ran during disabled,
   * autonomous, teleoperated and test.
   *
   * <p>This runs after the mode specific periodic functions, but before
   * LiveWindow and SmartDashboard integrated updating.
   */
  @Override
  public void robotPeriodic() {
  }

  /**
   * This function is called once each time the robot enters Disabled mode.
   * You can use it to reset any subsystem information you want to clear when
   * the robot is disabled.
   */
  @Override
  public void disabledInit() {
    m_driveTrain.disable();
    m_elbow.disable();
    m_wrist.disable();
  }

  @Override
  public void disabledPeriodic() {
    Scheduler.getInstance().run();
  }

  /**
   * This autonomous (along with the chooser code above) shows how to select
   * between different autonomous modes using the dashboard. The sendable
   * chooser code works with the Java SmartDashboard. If you prefer the
   * LabVIEW Dashboard, remove all of the chooser code and uncomment the
   * getString code to get the auto name from the text box below the Gyro
   *
   * <p>You can add additional auto modes by adding additional commands to the
   * chooser code above (like the commented example) or additional comparisons
   * to the switch structure below with additional strings & commands.
   */
  @Override
  public void autonomousInit() {
    m_autonomousCommand = m_chooser.getSelected();

    /*
     * String autoSelected = SmartDashboard.getString("Auto Selector",
     * "Default"); switch(autoSelected) { case "My Auto": autonomousCommand
     * = new MyAutoCommand(); break; case "Default Auto": default:
     * autonomousCommand = new ExampleCommand(); break; }
     */

    // schedule the autonomous command (example)
    if (m_autonomousCommand != null) {
      m_autonomousCommand.start();
    }
  }

  /**
   * This function is called periodically during autonomous.
   */
  @Override
  public void autonomousPeriodic() {
    Scheduler.getInstance().run();
  }

  @Override
  public void teleopInit() {
    if (m_autonomousCommand != null) {
      m_autonomousCommand.cancel();
    }
    m_driveTrain.enable();
    m_driveTrain.resetGyroYaw();
    m_elbow.disable();
    m_wrist.disable();
    m_elbow.resetAngle();
    m_wrist.resetAngle();
  }

  @Override
  public void teleopPeriodic() {
    m_elbow.enable();
    m_wrist.enable();
/*
    if (m_oi.m_operator.getRawButton(1)){
      if (m_elbow.getAngle() > 80){
        m_wrist.setAngle(-50);
      }
      m_elbow.setAngle(120);
    }
    */
    if (m_oi.m_operator.getRawButton(3)){
      m_elbow.resetAngle();
      m_wrist.resetAngle();
    }
    
    Scheduler.getInstance().run();
  }

  @Override
  public void testPeriodic() {
    elbow.set(m_oi.m_operator.getRawAxis(1)*0.3);
    wrist.set(m_oi.m_operator.getRawAxis(5)*0.1);
  }
}
