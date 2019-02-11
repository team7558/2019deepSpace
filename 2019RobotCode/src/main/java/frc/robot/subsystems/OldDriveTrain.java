/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.*/
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import com.ctre.phoenix.sensors.PigeonIMU;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import edu.wpi.first.wpilibj.command.PIDSubsystem;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import frc.robot.RobotMap;
import frc.robot.commands.JoyDrive;
import frc.robot.Robot;

/**
 * Add your docs here.
 */
public class OldDriveTrain extends PIDSubsystem {
  private PigeonIMU m_pidgey = new PigeonIMU(RobotMap.DRIVE_PIGEON); 
  private double[] ypr = new double[3];
  private CANSparkMax[] m_motors = new CANSparkMax[7];
  private CANEncoder[] m_motorEncoders = new CANEncoder[7];
  private SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  private DifferentialDrive m_driveTrain;
  private double targetHeading = 0;
  private Solenoid m_shifter;
  private boolean m_useGyro = false; // Call resetGyro before setting to true
  private double m_driveSpeed = 0;
  private double m_turnRate = 0;
  private boolean m_brakeEnabled = false;

  /**
   * Add your docs here.
   */
  public OldDriveTrain() {
    // Intert a subsystem name and PID values here
    super("OldDriveTrain", 0.03, 0, 0.05); // kp, ki, kd
    setSetpoint(targetHeading);

    m_motors[1] = new CANSparkMax(RobotMap.LEFT_MOTOR_1, MotorType.kBrushless);
    m_motors[2] = new CANSparkMax(RobotMap.LEFT_MOTOR_2, MotorType.kBrushless);
    m_motors[3] = new CANSparkMax(RobotMap.LEFT_MOTOR_3, MotorType.kBrushless);
    m_motors[4] = new CANSparkMax(RobotMap.RIGHT_MOTOR_1, MotorType.kBrushless);
    m_motors[5] = new CANSparkMax(RobotMap.RIGHT_MOTOR_2, MotorType.kBrushless);
    m_motors[6] = new CANSparkMax(RobotMap.RIGHT_MOTOR_3, MotorType.kBrushless);
    for (int i = 0; i < m_motors.length; i++) {
      m_motorEncoders[i] = new CANEncoder(m_motors[i]);
    }
    m_leftMotorGroup = new SpeedControllerGroup(m_motors[1], m_motors[2], m_motors[3]);
    m_rightMotorGroup = new SpeedControllerGroup(m_motors[4], m_motors[5], m_motors[6]);
    m_driveTrain = new DifferentialDrive(m_rightMotorGroup, m_leftMotorGroup);
    m_shifter = new Solenoid(RobotMap.SHIFTER);
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    setDefaultCommand(new JoyDrive());
  }

  @Override
  protected double returnPIDInput() {
    // Return your input value for the PID loop
    // get yaw, pitch, roll and store in ypr array
    // We should add something to check if the value we return makes sense so that
    // the robot doesnt make any jerking motions.
    return getGyroYaw();

  }

  @Override
  protected void usePIDOutput(double output) {
    // If useGyro is true, pid output will be used to turn and target heading will be calculated
    if (m_useGyro && !m_brakeEnabled) {
      targetHeading += m_turnRate;
      setSetpoint(targetHeading);
      m_driveTrain.arcadeDrive(m_driveSpeed, output);
      // System.out.println("Output: " + output + " TargetHeading: " + targetHeading);
    } else if(!m_brakeEnabled) {
      m_driveTrain.arcadeDrive(m_driveSpeed, -m_turnRate);
    }
  }

  public void stop() {
    m_brakeEnabled = true;
    m_leftMotorGroup.set(0);
    m_rightMotorGroup.set(0);
  }

  public double getLeftAngle() {
    return (m_motorEncoders[1].getPosition() + m_motorEncoders[2].getPosition() + m_motorEncoders[3].getPosition()) / 3;
  }

  public double getRightAngle() {
    return (m_motorEncoders[4].getPosition() + m_motorEncoders[5].getPosition() + m_motorEncoders[6].getPosition()) / 3;
  }

  public double getGyroYaw() {
    m_pidgey.getYawPitchRoll(ypr);
    return ypr[0];
  }

  public void resetGyroYaw() {
    m_pidgey.setYaw(0);
    targetHeading = 0;
  }

  public void setSolenoid(boolean a) {
    m_shifter.set(a);
  }

  public void shiftUp() {
    Robot.m_driveTrain.setSolenoid(false);
  }

  public void shiftDown() {
    Robot.m_driveTrain.setSolenoid(true);
  }

  public void drive(double driveSpeed, double turnRate, boolean useGyro){
    this.m_driveSpeed = driveSpeed;
    this.m_turnRate = turnRate;
    this.m_useGyro = useGyro;
  }

}
