/*----------------------------------------------------------------------------*/
/* Copyright (c) 2017-2018 FIRST. All Rights Reserved.                        */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot;

import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.Compressor;
import edu.wpi.first.wpilibj.TimedRobot;
import edu.wpi.first.wpilibj.command.Command;
import edu.wpi.first.wpilibj.command.Scheduler;
import edu.wpi.first.wpilibj.smartdashboard.SendableChooser;
import edu.wpi.first.wpilibj.smartdashboard.SmartDashboard;
import frc.robot.commands.JoyDrive;
import frc.robot.commands.ShootCargoFront;
import frc.robot.subsystems.*;

/**
 * The VM is configured to automatically run this class, and to call the
 * functions corresponding to each mode, as described in the TimedRobot
 * documentation. If you change the name of this class or the package after
 * creating this project, you must also update the build.gradle file in the
 * project.
 */
public class Robot extends TimedRobot {

  public static OI m_oi;
  public static Claw m_claw;
  public static Arm m_arm;
  public static EndGame m_endGame;
  public static DriveTrain m_driveTrain;

  public static JoyDrive m_joyDrive;
  
  private CANSparkMax elbow, wrist;
  
  public static Compressor m_Compressor;

  public static WPI_VictorSPX m_hatchSuck;

  Command m_autonomousCommand;
  SendableChooser<Command> m_chooser = new SendableChooser<>();

  /**
   * This function is run when the robot is first started up and should be
   * used for any initialization code.
   */
  @Override
  public void robotInit() {

    m_claw = new Claw();
    m_arm = new Arm(43, new Elbow(), new Wrist());
    m_driveTrain = new DriveTrain();
    m_oi = new OI();

    m_joyDrive = new JoyDrive();

    m_hatchSuck = new WPI_VictorSPX(12);

    SmartDashboard.putData("Auto mode", m_chooser);    

    //m_Compressor = new Compressor(RobotMap.COMPRESSOR);
    //m_Compressor.start();
    //m_Compressor.setClosedLoopControl(true);
 
    elbow = new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless);
    wrist = new CANSparkMax(RobotMap.WRIST_MOTOR, MotorType.kBrushless);
   
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
    m_arm.disable();
    //m_joyDrive.cancel();
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

  public ShootCargoFront shoo;

  @Override
  public void teleopInit() {
    if (m_autonomousCommand != null) {
      m_autonomousCommand.cancel();
    }    
    Scheduler.getInstance().removeAll();
    m_arm.zero();
    m_arm.hold();
    m_arm.enable();
    m_joyDrive.start();
  }

  @Override
  public void teleopPeriodic() {
    //m_joyDrive.start();
    //m_arm.setAngle(new double[]{45, 0});
    //m_arm.goToPreset("INTAKE_HATCH_HUMAN");
    //System.out.println(m_arm.getAngles()[1]);
    System.out.println(Robot.m_oi.m_operator.getPOV(0));
    Scheduler.getInstance().run();
    m_oi.checkPresets();
  }

  @Override
  public void testPeriodic() {
    elbow.set(m_oi.m_operator.getRawAxis(1)*0.1);
    wrist.set(m_oi.m_operator.getRawAxis(5)*0.1);
  }
}
