/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;

import com.ctre.phoenix.motorcontrol.can.WPI_VictorSPX;

import edu.wpi.first.wpilibj.Encoder;
import edu.wpi.first.wpilibj.Solenoid;
import edu.wpi.first.wpilibj.SpeedController;
import edu.wpi.first.wpilibj.SpeedControllerGroup;
import edu.wpi.first.wpilibj.drive.DifferentialDrive;
import edu.wpi.first.wpilibj.command.Subsystem;

import frc.robot.RobotMap;
import frc.robot.Util;
import frc.robot.Robot;

import edu.wpi.first.wpilibj.command.Subsystem;

/**
 * Add your docs here.
 */
public class Drivetrain extends Subsystem {
  // Put methods for controlling this subsystem
  // here. Call these from Commands.

  private SpeedController[] m_leftMotors, m_rightMotors;
  private SpeedControllerGroup m_leftMotorGroup, m_rightMotorGroup;
  private DifferentialDrive m_diffDrive;
  private CANEncoder m_leftEncoder, m_rightEncoder;
  private double m_leftZero, m_rightZero;

  private double m_maxStraightSpeed, m_maxTurnSpeed;

  public Drivetrain() {
    m_leftMotors = new SpeedController[RobotMap.NUM_DRIVE_MOTORS];
    m_rightMotors = new SpeedController[RobotMap.NUM_DRIVE_MOTORS];
    for (int i = 0; i < RobotMap.NUM_DRIVE_MOTORS; i++) {
      if (RobotMap.USING_NEOS) {
        m_leftMotors[i] = new CANSparkMax(RobotMap.LEFT_DRIVE_MOTORS[i], MotorType.kBrushless);
        m_rightMotors[i] = new CANSparkMax(RobotMap.RIGHT_DRIVE_MOTORS[i], MotorType.kBrushless);
      } else {
        m_leftMotors[i] = new WPI_VictorSPX(RobotMap.LEFT_DRIVE_MOTORS[i]);
        m_rightMotors[i] = new WPI_VictorSPX(RobotMap.RIGHT_DRIVE_MOTORS[i]);
      }
    }
    switch (RobotMap.NUM_DRIVE_MOTORS) {
    case (1):
      m_leftMotorGroup = new SpeedControllerGroup(m_leftMotors[0]);
      m_rightMotorGroup = new SpeedControllerGroup(m_rightMotors[0]);
      break;      
    case (2):
      m_leftMotorGroup = new SpeedControllerGroup(m_leftMotors[0], m_leftMotors[1]);
      m_rightMotorGroup = new SpeedControllerGroup(m_rightMotors[0], m_rightMotors[1]);
      break;
    case (3):
      m_leftMotorGroup = new SpeedControllerGroup(m_leftMotors[0], m_leftMotors[1], m_leftMotors[2]);
      m_rightMotorGroup = new SpeedControllerGroup(m_rightMotors[0], m_rightMotors[1], m_rightMotors[2]);
      break;
    }
    m_diffDrive = new DifferentialDrive(m_leftMotorGroup, m_rightMotorGroup);
    if (RobotMap.USING_ENCODERS) {
      if (RobotMap.USING_NEOS) {
        m_leftEncoder = new CANEncoder((CANSparkMax) m_leftMotors[0]);
        m_leftZero = m_leftEncoder.getPosition();
        m_rightEncoder = new CANEncoder((CANSparkMax) m_rightMotors[0]);
        m_rightZero = m_rightEncoder.getPosition();
      }
    }
    m_maxStraightSpeed = 0.8;
    m_maxTurnSpeed = 0.8;
  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  public void resetEncoders(){
    m_leftZero = m_leftEncoder.getPosition();
    m_rightZero = m_rightEncoder.getPosition();
  }

  public double[] getDistances(){
    return new double[]{m_leftEncoder.getPosition()-m_leftZero, m_rightEncoder.getPosition()-m_rightZero};
  } 

  public void tankDrive(double leftPower, double rightPower) {
    m_diffDrive.tankDrive(Util.checkSpeed(leftPower, m_maxStraightSpeed), Util.checkSpeed(rightPower, m_maxStraightSpeed));
  }

  public void arcadeDrive(double straightSpeed, double turn) {
    m_diffDrive.arcadeDrive(Util.checkSpeed(straightSpeed, m_maxStraightSpeed), Util.checkSpeed(turn, m_maxTurnSpeed));
  }

  public void setMaxSpeeds(double maxStraightSpeed, double maxTurnSpeed) {
    m_maxStraightSpeed = maxStraightSpeed;
    m_maxTurnSpeed = maxTurnSpeed;
  }



}
